@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Data Tables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Data Tables</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Leave Applications</h4>
                    <p class="card-title-desc">
                    </p>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="text-align: center;">NAME OF EMPLOYEE: </th>
                            <th style="text-align: center;">OFFICE/DIVISION:</th>
                            <th style="text-align: center;">FROM: </th>
                            <th style="text-align: center;">TO: </th>
                            <th style="text-align: center;">REASON: </th>
                            <th style="text-align: center;">LEAVE TYPE: </th>
                            <th style="text-align: center;">ACTION: </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($leaves as $leave)
                        <tr>
                            <td>{{ Str::ucfirst(strtolower($leave->user->firstname)) }}{{ " " }}{{ strtoupper(substr($leave->user->middlename,0,1)) }}{{ "." }}{{ " " }}{{ Str::ucfirst(strtolower($leave->user->lastname)) }}</td>
                            <td>{{ $leave->user->office_division }} </td>
                            <td>{{ \Carbon\Carbon::parse($leave->date2)->format('F j, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->date3)->format('F j, Y') }}</td>
                            <td>{{ strtoupper($leave->statusLeave->head) }}</td>
                            <td>
                                @if     ($leave->vacationLeave)                {{ $leave->vacationLeave->leave_type; }}
                                @elseif ($leave->mandatoryLeave)               {{ $leave->mandatoryLeave->leave_type;}}
                                @elseif ($leave->sickLeave)                    {{ $leave->sickLeave->leave_type; }}
                                @elseif ($leave->maternityLeave)               {{ $leave->maternityLeave->leave_type; }}
                                @elseif ($leave->paternityLeave)               {{ $leave->paternityLeave->leave_type; }}
                                @elseif ($leave->specialPrivilegeLeave)        {{ $leave->specialPrivilegeLeave->leave_type; }}
                                @elseif ($leave->soloParentLeave)              {{ $leave->soloParentLeave->leave_type; }}
                                @elseif ($leave->studyLeave)                   {{ $leave->studyLeave->leave_type; }}
                                @elseif ($leave->vawcLeave)                    {{ $leave->vawcLeave->leave_type; }}
                                @elseif ($leave->rehabilitationLeave)          {{ $leave->rehabilitationLeave->leave_type; }}
                                @elseif ($leave->specialLeaveBenefitsForWomen) {{ $leave->specialLeaveBenefitsForWomen->leave_type; }}
                                @elseif ($leave->calamityLeave)                {{ $leave->calamityLeave->leave_type; }}
                                @elseif ($leave->adoptionLeave)                {{ $leave->adoptionLeave->leave_type; }}
                                @endif
                            </td>

                            <td><button  class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#myModal-{{  $leave->id }}">View</button></td>
                            <div class="modal" id="myModal-{{ $leave->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title secondary">ACTION</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('leave-request.leaveApp.update' ,$leave->id) }}" method="POST">
                                            @method('PATCH')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <div class="mb-4">
                                                        <label class="form-label"><b>LEAVE APPLICATION FORM: </b></label>
                                                        <a type="button" class="btn btn-info center form-control" href="{{ route('leave.form',$leave->id) }}" target="_blank">View</a>
                                                    </div>
                                                    <div class="mb-4">
                                                        @if ($leave->sickLeave)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/sick/'.$leave->sickLeave->sick_leave_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>

                                                        @elseif ($leave->maternityLeave)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/maternity/'.$leave->maternityLeave->maternity_leave_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>

                                                        @elseif ($leave->paternityLeave)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/paternity/'.$leave->paternityLeave->paternity_leave_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>

                                                        @elseif ($leave->soloParentLeave)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/soloParent/'.$leave->soloParentLeave->solo_parent_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>

                                                        @elseif ($leave->studyLeave)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/study/'.$leave->studyLeave->study_leave_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>

                                                        @elseif ($leave->vawcLeave)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/vawc/'.$leave->vawcLeave->vawc_leave_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>

                                                        @elseif ($leave->rehabilitationLeave)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/rehabilitation/'.$leave->rehabilitationLeave->rehab_leave_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>

                                                        @elseif ($leave->specialLeaveBenefitsForWomen)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/specialLeaveBeneWomen/'.$leave->specialLeaveBenefitsForWomen->slb_leave_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>

                                                        @elseif ($leave->calamityLeave)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/calamity/'.$leave->calamityLeave->calamity_leave_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>

                                                        @elseif ($leave->adoptionLeave)
                                                        <label class="form-label"><b>ATTACHMENT(S): </b></label>
                                                        <a href="{{ asset('leaveAttachments/adoption/'.$leave->adoptionLeave->adoption_leave_attachment) }}" target="_blank" type="button" class="btn btn-info center form-control">View</a>


                                                        @endif
                                                    </div>


                                                </div>
                                                <div class="mb-3">
                                                    <div class="mb-4">
                                                        <label class="form-label"><b>STATUS: </b></label>
                                                        <select name="status" class="form-control" required="true">
                                                            <option value="" selected="true" disabled>Pending</option>
                                                            <option value="approved">Approved</option>
                                                            <option value="reject">Reject</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </tr>
                        @endforeach
                        </tbody>
                            {{-- <div class="modal" id="myModal-{{ $compassionate->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title secondary">View</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('compassionateTO.update' ,$compassionate->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PATCH')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <div class="mb-4">
                                                        <label class="form-label"><b>REGISTRATION FORM: </b></label>
                                                        <a type="button" class="btn btn-info center form-control" href="{{ route('compassionateTO.form', $compassionate->id) }}" target="_blank">View</a>
                                                    </div>

                                                    <label class="form-label">If for evaluation, type your message here.</label>
                                                    <textarea name="remark" id="" cols="30" rows="5" class="form-control" ></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="mb-4">
                                                        <label class="form-label"><b>STATUS: </b></label>
                                                        <select name="status" class="form-control" required="true">
                                                            <option value="" selected="true" disabled>Pending</option>
                                                            <option value="approved">Approved</option>
                                                            <option value="for evaluation">For evaluation</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                    <div>
                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label">Upload Certificate</label>
                                                            <input class="form-control" type="file" id="formFile" name="certificate">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-prima
                                                    ry">Update</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div> <!-- container-fluid -->

@endsection

