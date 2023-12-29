@extends('layouts.app')

@section('content')

<div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div class="col-4">
                        <h1 class="card-title" style="font-size: 20px">Civil Service Form No. 6</h1>
                    </div>
            
                    <div class="col-8">
                        <h1 class="card-title" style="font-size: 20px">APPLICATION FOR LEAVE</h1>
                    </div>
                </div>
                
                {{-- action="{{ route('compassionateTO.store') }}" method="POST" --}}

                <form class="needs-validation"> 
                    @csrf
                    <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="office/div" class="form-label">Office/Department</label>
                                    <input type="text" class="form-control" id="office/div"
                                        placeholder="Office/Division" value="{{ $user->office_division }}" required readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="pos" class="form-label">Lastname</label>
                                    <input type="text" class="form-control" id="pos"
                                        placeholder="Position" value="{{ Str::ucfirst(strtolower($user->lastname)) }}" required readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="pos" class="form-label">Firstname</label>
                                    <input type="text" class="form-control" id="pos"
                                        placeholder="Position" value="{{ Str::ucfirst(strtolower($user->firstname)) }}" required readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="pos" class="form-label">Middlename</label>
                                    <input type="text" class="form-control" id="pos"
                                        placeholder="Position" value="{{ Str::ucfirst(strtolower($user->middlename)) }}" required readonly>
                                </div>
                            </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="date1">Date of Filing</label>
                            <input type="date" class="form-control" id="date1" name="date1" value="" placeholder="Date of Filing" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" value="{{ $user->position }}" placeholder="Position" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary" value="{{ $user->salary }}" placeholder="Salary" readonly>
                        </div>

                        
                    </div>
                    <label for="leave">TYPE OF LEAVE TO BE AVAILED OF</label>
                    
                        <div class="col" id="leave" >
                            <label>
                                <input type="radio" name="leave_type" value="Vacation Leave" required>
                                Vacation Leave (Sec. 51, Rule XVI, Omnibus Rules Implementing E.O. No. 292)
                            </label><br>
                            {{-- style="display: none;" --}}
                            <div id="vacation" style="display: none" >
                                <div class="row mb-2">
                                    <label>
                                        <input type="radio" id="local" name="loc_choice" value="Within the Philippines" required>
                                        Within the Philippines
                                    </label>
                                    <div id="loc_choice1" class="col-sm-6" style="display: none">
                                        <input type="text" class="form-control" id="within_phil" placeholder="" name="within_phil" required>
                                    </div>
                                    

                                    <label>
                                        <input type="radio" id="abroad_choice" name="loc_choice" value="Abroad" required>
                                        Abroad (Specify)
                                    </label>
                                    <div id="loc_choice2" class="col-sm-6" style="display: none">
                                        <input type="text" class="form-control" id="abroad" placeholder="" name="abroad" required>
                                    </div>
                                </div>
                            </div>

                            <label>
                                <input type="radio" name="leave_type" value="Mandatory/Forced Leave" required>
                                Mandatory/Forced Leave   (Sec. 25, Rule XVI, Omnibus Rules Implementing E.O. No. 292)
                            </label><br>
                            <div id="mandatory" style="display: none" >
                                <div class="row mb-2">
                                    <label>
                                        <input type="radio" id="local2" name="mandatory_choice" value="Within the Philippines" required>
                                        Within the Philippines
                                    </label>
                                    <div id="m_choice1" class="col-sm-6" style="display: none">
                                        <input type="text" class="form-control" id="phil" placeholder="" name="phil" required>
                                    </div>
                                    

                                    <label>
                                        <input type="radio" id="abroad_choice2" name="mandatory_choice" value="Abroad" required>
                                        Abroad (Specify)
                                    </label>
                                    <div id="m_choice2" class="col-sm-6" style="display: none">
                                        <input type="text" class="form-control" id="international" placeholder="" name="international" required>
                                    </div>
                                </div>
                            </div>

                            

                            <label>
                                <input type="radio" name="leave_type" value="Sick Leave" required>
                                Sick Leave   (Sec. 43, Rule XVI, Omnibus Rules Implementing E.O. No. 292)
                            </label><br>

                            <label>
                                <input type="radio" name="leave_type" value="Maternity Leave" required>
                                Maternity Leave   (R.A. No. 11210/IRR issued by CSC, DOLE and SSS) 
                            </label><br>

                            <label>
                                <input type="radio" name="leave_type" value="Paternity Leave" required>
                                Paternity Leave   (R.A. No. 8187 / CSC MC No. 71, s. 1998, as amended)
                            </label><br>

                            <label>
                                <input type="radio" name="leave_type" value="Special Privilege Leave" required>
                                Special Privilege Leave   (Sec. 21, Rule XVI, Omnibus Rules Implementing E.O. No. 292)
                            </label><br>
                            <div id="special" style="display: none" >
                                <div class="row mb-2">
                                    <label>
                                        <input type="radio" id="local3" name="spl_choice" value="Within the Philippines" required>
                                        Within the Philippines
                                    </label>
                                    <div id="spl_choice1" class="col-sm-6" style="display: none">
                                        <input type="text" class="form-control" id="spl_phil" placeholder="" name="spl_phil" required>
                                    </div>
                                    

                                    <label>
                                        <input type="radio" id="abroad_choice3" name="spl_choice" value="Abroad" required>
                                        Abroad (Specify)
                                    </label>
                                    <div id="spl_choice2" class="col-sm-6" style="display: none">
                                        <input type="text" class="form-control" id="spl_international" placeholder="" name="spl_international" required>
                                    </div>
                                </div>
                            </div>

                            <label>
                                <input type="radio" name="leave_type" value="Solo Parent Leave" required>
                                Solo Parent Leave   (R.A. No. 8972 / CSC MC No. 8, s.2004)
                            </label><br>
                            <div style="margin-bottom: 15px; display:none" id="solo" style="" >
                                <div class="row mb-6">
                                    <label>
                                        Attachment(s):
                                    </label>
                                    <div id="solo_parent" class="col-sm-6">
                                        <input type="file" class="form-control" id="solo_parent_attachment" placeholder="" name="solo_parent_attachment" required>
                                    </div>
                                </div>
                            </div>

                            <label>
                                <input type="radio" name="leave_type" value="Study Leave" required>
                                Study Leave   (Sec. 68, Rule XVI, Omnibus Rules Implementing E.O. No. 292)
                            </label><br>
                            <div style="margin-bottom: 15px; display:none" id="study" style="" >
                                <label>
                                    <input type="radio" name="study_choice" id="masters"value="Completion of Master's Degree" >
                                    Completion of Master's Degree
                                </label><br>
    
                                <label>
                                    <input type="radio" name="study_choice" id="exam" value="BAR/Board Examination Review" >
                                    BAR/Board Examination Review
                                </label><br>
                                <div class="row mb-6">
                                    <label>
                                        Attachment(s):
                                    </label>
                                    <div id="study_leave" class="col-sm-6">
                                        <input type="file" class="form-control" id="study_leave_attachment" placeholder="" name="study_leave_attachment" required>
                                    </div>
                                </div>
                            </div>

                            <label>
                                <input type="radio" name="leave_type" value="10-Day VAWC Leave" required>
                                10-Day VAWC Leave   (R.A. No. 9262 / CSC MC No. 15, s.2004)
                            </label><br>
                            <div style="margin-bottom: 15px; display:none" id="vawc" style="" >
                                <div class="row mb-6">
                                    <label>
                                        Attachment(s):
                                    </label>
                                    <div id="vawc_leave" class="col-sm-6">
                                        <input type="file" class="form-control" id="vawc_leave_attachment" placeholder="" name="vawc_leave_attachment" required>
                                    </div>
                                </div>
                            </div>
                            <label>
                                <input type="radio" name="leave_type" value="Rehabilitation Privilege" required>
                                Rehabilitation Privilege   (Sec. 55, Rule XVI, Omnibus Rules Implementing E.O. No. 292)
                            </label><br>
                            <div style="margin-bottom: 15px; display:none" id="rehab" style="" >
                                <div class="row mb-6">
                                    <label>
                                        Attachment(s):
                                    </label>
                                    <div id="rehab_leave" class="col-sm-6">
                                        <input type="file" class="form-control" id="rehab_leave_attachment" placeholder="" name="rehab_leave_attachment" required>
                                    </div>
                                </div>
                            </div>

                            <label>
                                <input type="radio" name="leave_type" value="Special Leave Benefits for Women" required>
                                Special Leave Benefits for Women   (R.A. No. 9710 / CSC MC No. 15, s.2010)
                            </label><br>
                            <div style="margin-bottom: 15px; display:none" id="slb" style="" >
                                <div class="row mb-6">
                                    <label>
                                        Attachment(s):
                                    </label>
                                    <div id="slb_leave" class="col-sm-6">
                                        <input type="file" class="form-control" id="slb_leave_attachment" placeholder="" name="slb_leave_attachment" required>
                                    </div>
                                </div>
                            </div>

                            <label>
                                <input type="radio" name="leave_type" value="Special Emergency (Calamity) Leave" required>
                                Special Emergency (Calamity) Leave   (RCSC MC No. 15, s.2010, as amended)
                            </label><br>

                            <label>
                                <input type="radio" name="leave_type" value="Adoption Leave" required>
                                Adoption Leave   (R.A. No. 8552)
                            </label><br>

                        </div>

                    

                    <div class="row mb-3">
                        <div class="col-sm">
                            <label for="date2" class="col-sm-2 col-form-label">Start date</label>
                            <input class="form-control" type="date" value="" id="date2" name="date2">
                        </div>

                        <div class="col-sm">
                            <label for="date3" class="col-sm-2 col-form-label">Finish Date</label>
                            <input class="form-control" type="date" value="" id="date3" name="date3">
                        </div>
                    </div>
                    
                    
                    
                    <input type="text" id="myInput" name="leave_days" hidden>
                    

                    
                    {{-- onclick="calculateWeekdaysAndHolidays()" --}}
                    <div class="mb-5">
                        <button  class="btn btn-primary" type="submit" value="submit">Submit form</button>
                    </div>

                    
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
<!-- end row -->

<script>

    let today = new Date();
    let year = today.getFullYear();
    let month = String(today.getMonth() + 1).padStart(2, '0');
    let day = String(today.getDate()).padStart(2, '0');
    let formattedDate = `${year}-${month}-${day}`;
    const startDateInput = document.getElementById('date2');
    const endDateInput = document.getElementById('date3');

    startDateInput.addEventListener('input', () => {
    const startDate = new Date(startDateInput.value);
    const endDate = new Date(endDateInput.value);
    if (endDate < startDate) {
        endDateInput.value = startDateInput.value;
    }
    });
    
    endDateInput.addEventListener('input', () => {
    const startDate = new Date(startDateInput.value);
    const endDate = new Date(endDateInput.value);
    if (endDate < startDate) {
        endDateInput.value = startDateInput.value;
    }
    });
    
    // Set the input field value to the current date
    document.getElementById("date1").value = formattedDate;
    document.getElementById("date2").value = formattedDate;
    document.getElementById("date3").value = formattedDate;

    // Array of holiday dates
    const HOLIDAYS = [
        '2022-01-01', // New Year's Day
        '2022-01-17', // Martin Luther King Jr. Day
        '2022-02-21', // Presidents' Day
        '2022-05-30', // Memorial Day
        '2022-07-04', // Independence Day
        '2022-09-05', // Labor Day
        '2022-10-10', // Columbus Day
        '2022-11-11', // Veterans Day
        '2022-11-24', // Thanksgiving Day
        '2022-12-25', // Christmas Day
      ];

      // Function to check if a date is a weekend day
      function isWeekend(date) {
        const day = date.getDay();
        return day === 0 || day === 6; // Sunday is 0, Saturday is 6
      }

      // Function to check if a date is a holiday
      function isHoliday(date) {
        const dateString = date.toISOString().slice(0, 10);
        return HOLIDAYS.includes(dateString);
      }

      // Function to calculate weekdays and holidays
      function calculateWeekdaysAndHolidays() {
        // Get the input values
        const date1 = new Date(document.getElementById("date1").value);
        const date2 = new Date(document.getElementById("date2").value);
        const date3 = new Date(document.getElementById("date3").value);
        
        // Calculate the difference between the two dates in days
        const diffInDays = Math.floor((date2 - date1) / (1000 * 60 * 60 * 24));
        const diffInDays2 = Math.floor((date3 - date2) / (1000 * 60 * 60 * 24));
        // Initialize counters for weekdays and holidays
        let weekdays = 0;
        let holidays = 0;
        let weekdays2 = 0;
        let holidays2 = 0;

        // Loop through each day in the range and count weekdays and holidays
        for (let i = 0; i <= diffInDays; i++) {
          const currentDate = new Date(date1.getTime() + (i * 24 * 60 * 60 * 1000));
          if (!isWeekend(currentDate) && !isHoliday(currentDate)) {
            weekdays++;
          } else if (isHoliday(currentDate)) {
            holidays++;
          }
        }

        for (let i = 0; i <= diffInDays2; i++) {
          const currentDate2 = new Date(date2.getTime() + (i * 24 * 60 * 60 * 1000));
          if (!isWeekend(currentDate2) && !isHoliday(currentDate2)) {
            weekdays2++;
          } else if (isHoliday(currentDate2)) {
            holidays2++;
          }
        }

        if (weekdays >=5) {
            
        } else {
            event.preventDefault();
            alert("Must be at least 5 working days to apply for a leave");
            return false;
        }

        document.getElementById("myInput").value = weekdays2;

        // Display the result in the HTML page
        const resultElement = document.getElementById("result");
        resultElement.innerHTML = `Weekdays: ${weekdays}, Holidays: ${holidays}`;
      }


      vacation.style.marginLeft="5%"
      mandatory.style.marginLeft="5%"
      special.style.marginLeft="5%"
      solo.style.marginLeft="5%"
      study.style.marginLeft="5%"
      vawc.style.marginLeft="5%"
      rehab.style.marginLeft="5%"
      slb.style.marginLeft="5%"
        const leave_type = document.getElementsByName("leave_type");
        const loc_choice = document.getElementsByName("loc_choice"); //VL choice
        const mandatory_choice = document.getElementsByName("mandatory_choice"); //ML choice
        const spl_choice = document.getElementsByName("spl_choice"); //SPL choice
        const local = document.querySelector('#within_phil'); //VL textboxes
        const abroad = document.querySelector('#abroad'); //VL textboxes
        const m_local = document.querySelector('#phil'); //ML textboxes
        const m_abroad = document.querySelector('#international'); //ML textboxes
        const spl_local = document.querySelector('#spl_phil'); //SPL textboxes
        const spl_abroad = document.querySelector('#spl_international'); //SPL textboxes
        const solo_parent_attachment = document.querySelector('#solo_parent_attachment'); //S Parent L textboxes
        const study_leave_attachment = document.querySelector('#study_leave_attachment'); //Study Leave textboxes
        const vawc_leave_attachment = document.querySelector('#vawc_leave_attachment'); //
        const rehab_leave_attachment = document.querySelector('#rehab_leave_attachment'); //
        const slb_leave_attachment = document.querySelector('#slb_leave_attachment'); //
        local.disabled = true;
        abroad.disabled = true;
        m_local.disabled = true;
        m_abroad.disabled = true;
        spl_local.disabled = true;
        spl_abroad.disabled = true;
        solo_parent_attachment.disabled = true;
        study_leave_attachment.disabled = true;
        vawc_leave_attachment.disabled = true;
        rehab_leave_attachment.disabled = true;
    leave_type.forEach((button) => {
    button.addEventListener("change", () => {
        if (button.value === "Vacation Leave") {
            vacation.style.display = "block";
            mandatory.style.display = "none";
            special.style.display="none";
            solo.style.display = "none";
            vawc.style.display = "none";
            rehab.style.display = "none";
            slb.style.display = "none";
            document.getElementById("local").disabled = false; //radio buttons
            document.getElementById("abroad_choice").disabled = false; //radio buttons
            document.getElementById("local2").disabled = true; //ML radio buttons
            document.getElementById("abroad_choice2").disabled = true; //ML radio buttons
            document.getElementById("local3").disabled = true; //SPL radio buttons
            document.getElementById("abroad_choice3").disabled = true; //SPL radio buttons
            document.getElementById("masters").disabled = true;       //StudyL radio buttons
            document.getElementById("exam").disabled = true;          //StudyL radio buttons
            m_local.disabled = true; //textboxes
            m_abroad.disabled = true; //textboxes
            spl_local.disabled = true;
            spl_abroad.disabled = true;
            local.disabled = false; //textboxes
            abroad.disabled = false; //textboxes
            solo_parent_attachment.disabled = true;
            study_leave_attachment.disabled = true;
            vawc_leave_attachment.disabled = true;
            rehab_leave_attachment.disabled = true;

            loc_choice.forEach((button) => {
            button.addEventListener("change", () => {
                if (button.value === "Within the Philippines") {
                    loc_choice1.style.display = "block";
                    loc_choice2.style.display = "none";
                    local.disabled = false; //textboxes
                    abroad.disabled = true; //textboxes
                } else {
                    loc_choice1.style.display = "none";
                    loc_choice2.style.display = "block";
                    local.disabled = true; //textboxes
                    abroad.disabled = false; //textboxes
                }
                })
            });
        } else if (button.value === "Mandatory/Forced Leave") {
            vacation.style.display = "none";
            mandatory.style.display = "block";
            special.style.display="none";
            solo.style.display = "none";
            vawc.style.display = "none";
            rehab.style.display = "none";
            slb.style.display = "none";
            document.getElementById("local").disabled = true; //VL radio buttons
            document.getElementById("abroad_choice").disabled = true; // VL radio buttons
            document.getElementById("local2").disabled = false; //ML radio buttons
            document.getElementById("abroad_choice2").disabled = false; //ML radio buttons
            document.getElementById("local3").disabled = true; //ML radio buttons
            document.getElementById("abroad_choice3").disabled = true; //ML radio buttons
            document.getElementById("masters").disabled = true;       //StudyL radio buttons
            document.getElementById("exam").disabled = true;          //StudyL radio buttons
            m_local.disabled = false; //textboxes
            m_abroad.disabled = false; //textboxes
            spl_local.disabled = true;
            spl_abroad.disabled = true;
            solo_parent_attachment.disabled = true;
            local.disabled = true; //textboxes
            abroad.disabled = true; //textboxes
            study_leave_attachment.disabled = true;
            vawc_leave_attachment.disabled = true;
            rehab_leave_attachment.disabled = true;

            mandatory_choice.forEach((button) => {
            button.addEventListener("change", () => {
                if (button.value === "Within the Philippines") {
                    m_choice1.style.display = "block";
                    m_choice2.style.display = "none";
                    m_local.disabled = false; //textboxes
                    m_abroad.disabled = true; //textboxes
                } else {
                    m_choice1.style.display = "none";
                    m_choice2.style.display = "block";
                    m_local.disabled = true; //textboxes
                    m_abroad.disabled = false; //textboxes
                }
                })
            });
        } else if (button.value === "Special Privilege Leave") {
            special.style.display="block";
            vacation.style.display = "none";
            mandatory.style.display = "none";
            solo.style.display = "none";
            vawc.style.display = "none";
            rehab.style.display = "none";
            slb.style.display = "none";
            document.getElementById("local").disabled = true; //VL radio buttons
            document.getElementById("abroad_choice").disabled = true; //VL radio buttons
            document.getElementById("local2").disabled = true; //ML radio buttons
            document.getElementById("abroad_choice2").disabled = true; //ML radio buttons
            document.getElementById("local3").disabled = false; //SPL radio buttons
            document.getElementById("abroad_choice3").disabled = false; //SPL radio buttons
            document.getElementById("masters").disabled = true;       //StudyL radio buttons
            document.getElementById("exam").disabled = true;          //StudyL radio buttons
            m_local.disabled = true; //textboxes
            m_abroad.disabled = true; //textboxes
            spl_local.disabled = false;
            spl_abroad.disabled = false;
            solo_parent_attachment.disabled = true;
            local.disabled = true; //textboxes
            abroad.disabled = true; //textboxes
            study_leave_attachment.disabled = true;
            vawc_leave_attachment.disabled = true;
            rehab_leave_attachment.disabled = true;

            spl_choice.forEach((button) => {
            button.addEventListener("change", () => {
                if (button.value === "Within the Philippines") {
                    spl_choice1.style.display="block";
                    spl_choice2.style.display="none";
                    spl_local.disabled = false;
                    spl_abroad.disabled = true;
                } else {
                    spl_choice1.style.display="none";
                    spl_choice2.style.display="block";
                    spl_local.disabled = true;
                    spl_abroad.disabled = false;
                }
                })
            });
            
        } else if (button.value === "Solo Parent Leave"){
            solo.style.display = "block";
            vacation.style.display = "none";
            mandatory.style.display = "none";
            special.style.display="none";
            vawc.style.display = "none";
            rehab.style.display = "none";
            slb.style.display = "none";
            study.style.display= "none";
            study_leave_attachment.disabled = true;
            solo_parent_attachment.disabled = false;
            vawc_leave_attachment.disabled = true;
            rehab_leave_attachment.disabled = true;
            slb_leave_attachment.disabled = true;
            m_local.disabled = true; //textboxes
            m_abroad.disabled = true; //textboxes
            spl_local.disabled = true;
            spl_abroad.disabled = true;
            local.disabled = true; //textboxes
            abroad.disabled = true; //textboxes
            document.getElementById("local").disabled = true;         //VL radio buttons
            document.getElementById("abroad_choice").disabled = true; //VL radio buttons
            document.getElementById("local2").disabled = true;        //ML radio buttons
            document.getElementById("abroad_choice2").disabled = true;//ML radio buttons
            document.getElementById("local3").disabled = true;        //SPL radio buttons
            document.getElementById("abroad_choice3").disabled = true;//SPL radio buttons
            document.getElementById("masters").disabled = true;       //StudyL radio buttons
            document.getElementById("exam").disabled = true;          //StudyL radio buttons

        } else if (button.value === "Study Leave"){
            document.getElementById("masters").checked = true;
            study.style.display= "block";
            solo.style.display = "none";
            vacation.style.display = "none";
            mandatory.style.display = "none";
            special.style.display="none";
            vawc.style.display = "none";
            rehab.style.display = "none";
            slb.style.display = "none";
            study_leave_attachment.disabled = false;
            solo_parent_attachment.disabled = true;
            vawc_leave_attachment.disabled = true;
            rehab_leave_attachment.disabled = true;
            slb_leave_attachment.disabled = true;
            local.disabled = true; //textboxes
            abroad.disabled = true; //textboxes
            m_local.disabled = true; //textboxes
            m_abroad.disabled = true; //textboxes
            spl_local.disabled = true; //textboxes
            spl_abroad.disabled = true; //textboxes
            document.getElementById("local").disabled = true;         //VL radio buttons
            document.getElementById("abroad_choice").disabled = true; //VL radio buttons
            document.getElementById("local2").disabled = true;        //ML radio buttons
            document.getElementById("abroad_choice2").disabled = true;//ML radio buttons
            document.getElementById("local3").disabled = true;        //SPL radio buttons
            document.getElementById("abroad_choice3").disabled = true;//SPL radio buttons
            document.getElementById("masters").disabled = false;       //StudyL radio buttons
            document.getElementById("exam").disabled = false;          //StudyL radio buttons

        } else if (button.value === "10-Day VAWC Leave"){
            vawc.style.display = "block";
            study.style.display= "none";
            solo.style.display = "none";
            vacation.style.display = "none";
            mandatory.style.display = "none";
            special.style.display="none";
            rehab.style.display = "none";
            slb.style.display = "none";
            vawc_leave_attachment.disabled = false;
            study_leave_attachment.disabled = true;
            solo_parent_attachment.disabled = true;
            rehab_leave_attachment.disabled = true;
            slb_leave_attachment.disabled = true;
            local.disabled = true; //textboxes
            abroad.disabled = true; //textboxes
            m_local.disabled = true; //textboxes
            m_abroad.disabled = true; //textboxes
            spl_local.disabled = true; //textboxes
            spl_abroad.disabled = true; //textboxes
            document.getElementById("local").disabled = true;         //VL     radio buttons
            document.getElementById("abroad_choice").disabled = true; //VL     radio buttons
            document.getElementById("local2").disabled = true;        //ML     radio buttons
            document.getElementById("abroad_choice2").disabled = true;//ML     radio buttons
            document.getElementById("local3").disabled = true;        //SPL    radio buttons
            document.getElementById("abroad_choice3").disabled = true;//SPL    radio buttons
            document.getElementById("masters").disabled = true;       //StudyL radio buttons
            document.getElementById("exam").disabled = true;          //StudyL radio buttons

        } else if (button.value === "Rehabilitation Privilege"){
            rehab.style.display = "block";
            vawc.style.display = "none";
            study.style.display= "none";
            solo.style.display = "none";
            vacation.style.display = "none";
            mandatory.style.display = "none";
            special.style.display="none";
            slb.style.display = "none";
            vawc_leave_attachment.disabled = true;
            study_leave_attachment.disabled = true;
            solo_parent_attachment.disabled = true;
            rehab_leave_attachment.disabled = false;
            slb_leave_attachment.disabled = true;
            local.disabled = true; //textboxes
            abroad.disabled = true; //textboxes
            m_local.disabled = true; //textboxes
            m_abroad.disabled = true; //textboxes
            spl_local.disabled = true; //textboxes
            spl_abroad.disabled = true; //textboxes
            document.getElementById("local").disabled = true;         //VL     radio buttons
            document.getElementById("abroad_choice").disabled = true; //VL     radio buttons
            document.getElementById("local2").disabled = true;        //ML     radio buttons
            document.getElementById("abroad_choice2").disabled = true;//ML     radio buttons
            document.getElementById("local3").disabled = true;        //SPL    radio buttons
            document.getElementById("abroad_choice3").disabled = true;//SPL    radio buttons
            document.getElementById("masters").disabled = true;       //StudyL radio buttons
            document.getElementById("exam").disabled = true;          //StudyL radio buttons

        } else if (button.value === "Special Leave Benefits for Women"){
            slb.style.display = "block";
            rehab.style.display = "none";
            vawc.style.display = "none";
            study.style.display= "none";
            solo.style.display = "none";
            vacation.style.display = "none";
            mandatory.style.display = "none";
            special.style.display= "none";
            vawc_leave_attachment.disabled = true;
            study_leave_attachment.disabled = true;
            solo_parent_attachment.disabled = true;
            rehab_leave_attachment.disabled = true;
            slb_leave_attachment.disabled = false;
            local.disabled = true; //textboxes
            abroad.disabled = true; //textboxes
            m_local.disabled = true; //textboxes
            m_abroad.disabled = true; //textboxes
            spl_local.disabled = true; //textboxes
            spl_abroad.disabled = true; //textboxes
            document.getElementById("local").disabled = true;         //VL     radio buttons
            document.getElementById("abroad_choice").disabled = true; //VL     radio buttons
            document.getElementById("local2").disabled = true;        //ML     radio buttons
            document.getElementById("abroad_choice2").disabled = true;//ML     radio buttons
            document.getElementById("local3").disabled = true;        //SPL    radio buttons
            document.getElementById("abroad_choice3").disabled = true;//SPL    radio buttons
            document.getElementById("masters").disabled = true;       //StudyL radio buttons
            document.getElementById("exam").disabled = true;          //StudyL radio buttons
        }
        })
    });
</script>



@endsection