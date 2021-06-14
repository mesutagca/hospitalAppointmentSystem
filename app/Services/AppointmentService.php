<?php


namespace App\Services;


use App\Enums\ExceptionMessages;
use App\Enums\ResponseCodes;
use App\Filters\Appointment\AppointmentListFilters;
use App\Filters\Patient\PatientListFilters;
use App\Http\Requests\Appointment\AppointmentStoreRequest;
use App\Http\Requests\Appointment\AppointmentListRequest;

use App\Models\Appointment;
use App\Models\Folder;
use App\Models\Medicine;
use App\Models\PatientDocument;
use App\Models\Recipe;
use App\Models\Treatment;
use App\Repositories\AppointmentRepository;
use App\Repositories\Contracts\AppointmentRepositoryContract;
use App\Repositories\Contracts\DoctorRepositoryContract;
use App\Repositories\Contracts\PatientrepositoryContract;
use App\Services\Contracts\AppointmentServiceContract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class AppointmentService implements AppointmentServiceContract
{
    private AppointmentRepositoryContract $appointmentRepository;
    private DoctorRepositoryContract $doctorRepository;
    private PatientRepositoryContract $patientRepository;

    public function __construct(AppointmentRepositoryContract $appointmentRepository, DoctorRepositoryContract $doctorRepository, PatientRepositoryContract $patientRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
        $this->doctorRepository = $doctorRepository;
        $this->patientRepository = $patientRepository;
    }

    public function list(AppointmentListRequest $request)
    {
        /** @var AppointmentListFilters $appointmentFilter */
        $appointmentFilter = app(AppointmentListFilters::class);
        $appointmentFilter->setFilters($request->all());

        $this->appointmentRepository->parseRequest($request->all());
        $this->appointmentRepository
            ->with([
                'patient','patient.user',

                'doctor','doctor.user', 'doctor.branch',

                'folder','folder.patientDocuments','folder.treatment','folder.treatment.recipe','folder.treatment.recipe.medicines',
            ])->withFilters($appointmentFilter);

        return $this->appointmentRepository->getAll(['*']);
    }

    public function show(Request $request, int $appointmentId): ?Model
    {
        $this->appointmentRepository->parseRequest($request->all());
        $this->appointmentRepository->with([
            'patient','patient.user',

            'doctor','doctor.user', 'doctor.branch',

            'folder','folder.diagnose','folder.patientDocuments','folder.treatment','folder.treatment.recipe','folder.treatment.recipe.medicines',
        ]);
        $apointment = $this->appointmentRepository->getById($appointmentId);

        return $apointment->load(['folder','folder.diagnose', 'folder.patientDocuments','folder.treatment','folder.treatment.recipe','folder.treatment.recipe.medicines']);
    }

    public function store(AppointmentStoreRequest $request): ?Model
    {
        $patient = Auth::user()->patient;
        /** @var Appointment|null $appointment */
        $appointment = null;

        $this->appointmentRepository->transaction(function () use ($patient, $request, &$appointment) {

            $appointment = $this->appointmentRepository->create(array_merge($request->validated(), ['patient_id' => $patient->id]));

            /** @var Folder $folder */
            $folder = $appointment->folder()->create($request->only('disease_detail'));

            if ($request->hasFile('disease_documents')) {

                foreach ($request->file('disease_documents') as $file) {

                    $fileName = Str::uuid();
                    $file->storeAs('PatientDocuments/' . $patient->id, $fileName);

                    $folder->patientDocuments()->create([
                        'name' => $file->getClientOriginalName(),
                        'path' => $fileName
                    ]);
                }
            }
        });

        return $appointment;

    }
    /**
     *
     * @param AppointmentStoreRequest $request
     * @param Appointment $appointment
     * @return Model|null
     */
    public function update(AppointmentStoreRequest $request, Appointment $appointment): ?Model
    {
        /** @var Folder $folder */
        $appointment->folder()->update($request->only('disease_detail'));
        $folder = $appointment->folder->find($appointment->folder->id);

        if ($request->hasFile('disease_documents')) {

            foreach ($request->file('disease_documents') as $file) {

                $fileName = Str::uuid();
                $file->storeAs('PatientDocuments/' . $appointment->patient->id, $fileName);

                $folder->patientDocuments()->create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $fileName
                ]);
            }
        }
        return $this->appointmentRepository->update($appointment, $request->validated());
    }

    public function delete(?Model $appointment): ?bool
    {
        /** @var Folder $folder */
        $folder = $appointment->folder();

        $this->appointmentRepository->transaction(function () use ($appointment, $folder) {

            dd($folder->patientDocuments());
            foreach ($folder  as $patientDocument){
                dd($patientDocument);
                $patientDocument->delete();
            }

            $appointment->folder()->delete();

            return $this->appointmentRepository->delete($appointment);
        });
    }

    public function deletePatientDocument(?Model $appointment, $patient_path): ?bool
    {

                $patientDocument = $appointment->folder->patientDocuments()->where('patient_documents.path', $patient_path)->first();
                $path = '/PatientDocuments/' . $appointment->patient_id . '/' . $patient_path;
                Storage::delete($path);
              return  $this->appointmentRepository->delete($patientDocument);




    }


}
