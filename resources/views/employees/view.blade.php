@extends('layouts.admin')

@section('content')
    <style>
        body {
            background: #f4f7f6;
        }

        :root {
            --theme: #006644;
            --theme-light: #e8f6f1;
        }

        .profile-container {
            display: flex;
            gap: 25px;
        }

        .sidebar-card {
            width: 400px;
            background: linear-gradient(135deg, #ffffff 0%, #f6fffb 100%);
            border-radius: 22px;
            padding: 32px 25px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 20px;
            height: fit-content;
            border: 1px solid #e3f4ee;
            transition: 0.3s;
        }


        .sidebar-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.12);
        }

        .sidebar-photo {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 18px;
            box-shadow: 0 4px 18px rgba(0, 100, 68, 0.25);
            border: 4px solid #ffffff;
        }

        .sidebar-name {
            font-size: 1.45rem;
            font-weight: 800;
            margin-bottom: 6px;
            color: #003322;
        }

        .sidebar-designation {
            background: var(--theme);
            padding: 6px 14px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 30px;
            color: white;
            display: inline-block;
            margin-bottom: 15px;
        }

        .sidebar-id {
            background: #e8fff5;
            padding: 8px 14px;
            border-radius: 10px;
            text-align: center;
            font-size: 0.9rem;
            color: #006644;
            font-weight: 700;
            margin-bottom: 25px;
            border: 1px solid #c9efdd;
        }

        .sidebar-info-title {
            font-size: 0.85rem;
            color: #777;
            margin-bottom: 2px;
        }

        .sidebar-info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #222;
            margin-bottom: 10px;
        }

        .content-card {
            flex: 1;
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.09);
        }

        .tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .tabs::-webkit-scrollbar {
            height: 6px;
        }

        .tabs::-webkit-scrollbar-thumb {
            background-color: rgba(0, 100, 68, 0.5);
            border-radius: 3px;
        }

        .tabs .nav-item {
            flex: 0 0 auto;
        }

        .tabs .nav-link {
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 12px 12px 0 0;
            color: #444;
            margin-right: 5px;
            transition: 0.3s;
            background: #f4f7f6;
            border: 1px solid #e0f1ea;
            border-bottom: none;
        }

        .tabs .nav-link:hover {
            background: #e6f2ed;
            color: var(--theme);
        }

        .tabs .nav-link.active {
            background: var(--theme);
            color: white !important;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0, 100, 68, 0.25);
            transform: translateY(-2px);
            border-color: var(--theme);
        }


        .info-box {
            padding: 18px;
            border-radius: 14px;
            background: #f4faf7;
            border: 1px solid #d5e7df;
            margin-bottom: 15px;
            transition: 0.25s;
        }

        .info-box:hover {
            background: var(--theme-light);
            border-color: var(--theme);
        }

        .label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #6e7d77;
            margin-bottom: 4px;
        }

        .value {
            font-size: 1rem;
            font-weight: 700;
            color: #222;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 15px;
            border-left: 6px solid var(--theme);
            padding-left: 12px;
        }

        .btn-green {
            background: var(--theme);
            color: white;
            font-weight: 600;
        }

        .btn-green:hover {
            background: #004d33;
            color: white;
        }

        .personal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .personal-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 18px;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: 0.3s;
            border: 1px solid #e0f1ea;
        }

        .personal-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
        }

        .personal-card .icon {
            font-size: 1.6rem;
            color: var(--theme);
        }

        .personal-card .info .label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #6b7c74;
        }

        .personal-card .info .value {
            font-size: 1rem;
            font-weight: 700;
            color: #222;
        }

        .personal-card.full-width {
            grid-column: 1 / -1;
        }

        .personal-card.salary .icon {
            color: var(--gold);
        }

        .personal-card.bank .icon {
            color: var(--blue);
        }

        .personal-card.documents .icon {
            color: var(--purple);
        }
    </style>
    <a href="{{ url('/employees') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i> Back
    </a>

    <div class="mt-4 profile-container">

        <div class="text-center sidebar-card">
            <img src="{{ $employee->personalDetails->photo ?? asset('default.png') }}" class="sidebar-photo">
            <div class="sidebar-name">{{ $employee->user->name }}</div>
            <div class="sidebar-designation">
                {{ $employee->designation->designation ?? 'Employee' }}
            </div>
            <div class="sidebar-id">ID: {{ $employee->employee_id }}</div>

        </div>

        <div class="content-card">
            <ul class="mb-3 nav nav-tabs tabs" id="myTab">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#personal">Personal</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#employment">Employment</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#salary">Salary</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#bank">Bank</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#documents">Documents</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#education">Education</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="personal">
                    <h4 class="section-title">Personal Details</h4>
                    @php $pd = $employee->personalDetails; @endphp
                    <div class="personal-grid">

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-person-fill"></i></div>
                            <div class="info">
                                <p class="label">Full Name</p>
                                <p class="value">{{ $employee->user->name ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-gender-ambiguous"></i></div>
                            <div class="info">
                                <p class="label">Gender</p>
                                <p class="value">{{ $pd->gender ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-envelope-fill"></i></div>
                            <div class="info">
                                <p class="label">Email</p>
                                <p class="value">{{ $employee->user->email ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-phone-fill"></i></div>
                            <div class="info">
                                <p class="label">Phone Number</p>
                                <p class="value">{{ $employee->personalDetails->mobile_number ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-whatsapp"></i></div>
                            <div class="info">
                                <p class="label">WhatsApp Number</p>
                                <p class="value">{{ $pd->whatsapp_number ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-phone"></i></div>
                            <div class="info">
                                <p class="label">Alternate Number</p>
                                <p class="value">{{ $pd->alternate_number ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-heart-fill"></i></div>
                            <div class="info">
                                <p class="label">Marital Status</p>
                                <p class="value">{{ $pd->marital_status ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-calendar-event"></i></div>
                            <div class="info">
                                <p class="label">Date of Birth</p>
                                <p class="value">{{ $pd->dob ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-calendar3"></i></div>
                            <div class="info">
                                <p class="label">Age</p>
                                <p class="value">
                                    {{ $pd->dob ? \Carbon\Carbon::parse($pd->dob)->age : 'Not Updated' }}
                                </p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-person"></i></div>
                            <div class="info">
                                <p class="label">Father Name</p>
                                <p class="value">{{ $pd->father_name ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-person"></i></div>
                            <div class="info">
                                <p class="label">Mother Name</p>
                                <p class="value">{{ $pd->mother_name ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-person"></i></div>
                            <div class="info">
                                <p class="label">Spouse Name</p>
                                <p class="value">{{ $pd->spouse_name ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-droplet-half"></i></div>
                            <div class="info">
                                <p class="label">Blood Group</p>
                                <p class="value">{{ $pd->blood_group ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-geo-alt"></i></div>
                            <div class="info">
                                <p class="label">State</p>
                                <p class="value">{{ $pd->state ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-globe"></i></div>
                            <div class="info">
                                <p class="label">Country</p>
                                <p class="value">{{ $pd->country ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-person-lines-fill"></i></div>
                            <div class="info">
                                <p class="label">Emergency Contact Person</p>
                                <p class="value">{{ $pd->emergency_contact_name ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-people-fill"></i></div>
                            <div class="info">
                                <p class="label">Emergency Contact Relation</p>
                                <p class="value">{{ $pd->emergency_contact_relation ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-telephone-fill"></i></div>
                            <div class="info">
                                <p class="label">Emergency Contact Number</p>
                                <p class="value">{{ $pd->emergency_contact_phone ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card full-width">
                            <div class="icon"><i class="bi bi-geo-alt-fill"></i></div>
                            <div class="info">
                                <p class="label">Address</p>
                                <p class="value">{{ $pd->address ?? 'Not Updated' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="employment">
                    <h4 class="section-title">Employment Details</h4>
                    @php $pd = $employee->personalDetails; @endphp

                    <div class="personal-grid">

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-card-text"></i></div>
                            <div class="info">
                                <p class="label">Employment ID</p>
                                <p class="value">{{ $employee->employee_id ?? 'Not Updated' }}</p>
                            </div>
                        </div>
                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-award-fill"></i></div>
                            <div class="info">
                                <p class="label">Designation</p>
                                <p class="value">{{ $employee->designation->designation ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-briefcase-fill"></i></div>
                            <div class="info">
                                <p class="label">Status</p>
                                <p class="value">{{ $employee->employee_status ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-gear-fill"></i></div>
                            <div class="info">
                                <p class="label">Work Type</p>
                                <p class="value">{{ $employee->work_type ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-calendar-check-fill"></i></div>
                            <div class="info">
                                <p class="label">Joining Date</p>
                                <p class="value">{{ $pd->joining_date ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-calendar-x-fill"></i></div>
                            <div class="info">
                                <p class="label">Date of Relieving</p>
                                <p class="value">{{ $pd->relieving_date ?? 'Not Updated' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="salary">
                    <h4 class="section-title">Salary Details</h4>
                    @php $sd = $employee->salaryDetails; @endphp

                    <div class="personal-grid">
                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-cash-stack"></i></div>
                            <div class="info">
                                <p class="label">Basic Salary</p>
                                <p class="value">{{ $sd->basic_salary ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-piggy-bank-fill"></i></div>
                            <div class="info">
                                <p class="label">HRA</p>
                                <p class="value">{{ $sd->hra ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-wallet-fill"></i></div>
                            <div class="info">
                                <p class="label">Gross Salary</p>
                                <p class="value">{{ $sd->gross_salary ?? 'Not Updated' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="bank">
                    <h4 class="section-title">Bank Details</h4>
                    @php $bd = $employee->bankDetails; @endphp

                    <div class="personal-grid">
                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-bank2"></i></div>
                            <div class="info">
                                <p class="label">Bank Name</p>
                                <p class="value">{{ $bd->bank_name ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-credit-card-fill"></i></div>
                            <div class="info">
                                <p class="label">Account Number</p>
                                <p class="value">{{ $bd->account_number ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-code-slash"></i></div>
                            <div class="info">
                                <p class="label">IFSC</p>
                                <p class="value">{{ $bd->ifsc ?? 'Not Updated' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="documents">
                    <h4 class="section-title">Documents</h4>
                    @php $pd = $employee->personalDetails; @endphp

                    <div class="personal-grid">
                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-card-text"></i></div>
                            <div class="info">
                                <p class="label">Aadhar</p>
                                <p class="value">{{ $pd->aadhar ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-credit-card-2-front-fill"></i></div>
                            <div class="info">
                                <p class="label">PAN</p>
                                <p class="value">{{ $pd->pan ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-card-checklist"></i></div>
                            <div class="info">
                                <p class="label">Driving License</p>
                                <p class="value">{{ $pd->driving_license ?? 'Not Updated' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="education">
                    <h4 class="section-title">Educational Details</h4>
                    @php $ed = $employee->educationalDetails; @endphp
                    <div class="personal-grid">
                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-book-fill"></i></div>
                            <div class="info">
                                <p class="label">Highest Qualification</p>
                                <p class="value">{{ $ed->highest_qualification ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-building"></i></div>
                            <div class="info">
                                <p class="label">Institution</p>
                                <p class="value">{{ $ed->institution ?? 'Not Updated' }}</p>
                            </div>
                        </div>

                        <div class="personal-card">
                            <div class="icon"><i class="bi bi-calendar-event"></i></div>
                            <div class="info">
                                <p class="label">Year of Passing</p>
                                <p class="value">{{ $ed->year_of_passing ?? 'Not Updated' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
