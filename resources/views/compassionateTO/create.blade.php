@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div class="col-4">
                        <h1 class="card-title" style="font-size: 20px">HRDS-PAD Form</h1>
                    </div>

                    <div class="col-8">
                        <h1 class="card-title" style="font-size: 20px">COMPASSIONATE TIME-OFF</h1>
                    </div>
                </div>

                <form class="needs-validation" action="{{ route('compassionateTO.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name_of_employee" class="form-label">Name of Employee</label>
                                <input type="text" class="form-control" id="name_of_employee"
                                    placeholder="Name of Employee" value="{{ Str::ucfirst(strtolower($user->firstname)) }}{{ " " }}{{ strtoupper(substr($user->middlename,0,1)) }}{{ "." }}{{ " " }}{{ Str::ucfirst(strtolower($user->lastname)) }}" required readonly>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pos" class="form-label">Position</label>
                                <input type="text" class="form-control" id="pos"
                                    placeholder="Position" value="{{ $user->position }}" required readonly>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date1">Date of Filing</label>
                            <input type="date" class="form-control" id="date1" name="date1" value="" placeholder="Date of Filing" readonly>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="office/div" class="form-label">Office/Division</label>
                                <input type="text" class="form-control" id="office/div"
                                    placeholder="Office/Division" value="{{ $user->office_division }}" required readonly>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm">
                        <label for="date2" class="col-sm-2 col-form-label">Start Date</label>
                            <input class="form-control" type="date" value="" id="date2" name="date2">
                        </div>

                        <div class="col-sm">
                            <label for="date3" class="col-sm-2 col-form-label">Finish Date</label>
                                <input class="form-control" type="date" value="" id="date3" name="date3">
                            </div>
                    </div>

                    <div class="row">

                            <span class="mb-2">Reason (please check)</span>
                                <label>
                                    <input type="radio" name="reason" value="Filial Obligations" required>
                                    Filial obligations to parent and siblings for their medical and social needs
                                </label>

                                <div id="filial" style="display: none;">
                                    <div class="row mb-2">
                                        <label>
                                            <input type="radio" id="parent" name="choice" value="parent">
                                            Parent
                                        </label>
                                        <div id="choice1" class="col-sm-4" style="display: none;">
                                            <input type="text" class="form-control" id="name_of_parent" placeholder="Name of Parent" name="name_of_parent" required>
                                        </div>

                                        <label>
                                            <input type="radio" id="sibling" name="choice" value="sibling">
                                            Sibling
                                        </label>
                                        <div id="choice2" class="col-sm-4" style="display: none;">
                                            <input type="text" class="form-control" id="name_of_sibling" placeholder="Name of Sibling" name="name_of_sibling" required>
                                        </div>
                                    </div>
                                </div>

                                <label>
                                    <input type="radio" name="reason" value="Family Reunion" required>
                                    Family Reunions
                                </label>

                                <label>
                                    <input type="radio" name="reason" value="Death Anniversary"required>
                                    Death Anniversary of immediate family members for the first five (5) years of mourning
                                </label>
                                <div id="death_anniversary" style="display: none;">
                                    <div class="row">
                                        <label for="death_cert">Death certificate</label>
                                        <div class="col-md-6 mb-3">
                                            <input type="file" class="form-control" id="death_cert" placeholder="Death certificate" name="death_cert" required>
                                        </div>
                                    </div>
                                </div>

                                <label>
                                    <input type="radio" name="reason" value="Ante-mortem Activities" required>
                                    Ante-mortem activities involving immediate family members (due to lingering illness, whether at home or during confinement)
                                </label>
                                <div id="ante_mortem" style="display: none;">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="immediate_family_member" placeholder="Name of Immediate Family Member" name="immediate_family_member" required>
                                    </div>
                                    <label for="doc_cert" >Hospital abstract or Doctor's Certificate</label>
                                        <div class="col-md-6 mb-2">
                                            <input type="file" class="form-control" id="doc_cert" placeholder="Doctor's certificate" name="doc_cert" required>
                                        </div>
                                </div>

                                <label>
                                    <input type="radio" name="reason" value="Attendance in court hearings" required>
                                    Attendance in court hearings on personal capacity
                                </label>
                                <div id="court_attendance" style="display: none;">
                                    <label for="court_cert" >Please attach Notice of Hearing</label>
                                        <div class="col-md-6 mb-2">
                                            <input type="file" class="form-control" id="court_cert" placeholder="Court certificate" name="court_cert" required>
                                        </div>
                                </div>
                    </div>

                    <input type="text" id="myInput" name="leave_days" hidden>




                    <div class="mb-5">
                        <button onclick="calculateWeekdaysAndHolidays()" class="btn btn-primary" type="submit" value="submit">Submit form</button>
                    </div>

                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instructions:</label>
                        <p>
                            1. Employees are required to accomplish the Compassionate Time-off Form prior to their time-off based on the Guidlines for the Compassionate Time-off (CTO). Apprroved/signed CTO form must be attached to the DTRs/bundy cards upon submission to the Human Resource Development Service (HRDS) or the Personnel Unit of the Internal Management Services Division (IMSD) of each regional office.
                        </p>
                        <p>
                            2. Failure to submit the duly approved form shall be a ground for deduction from the employee's vacation leave credits. Such deduction shall be counted as whole day absence.
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
<!-- end row -->

<script>

    const reason = document.getElementsByName("reason");
    const choice = document.getElementsByName("choice");
    const name_of_parent = document.querySelector('#name_of_parent');
    const name_of_sibling = document.querySelector('#name_of_sibling');
    const death_cert = document.querySelector('#death_cert');
    const immediate_family_member = document.querySelector('#immediate_family_member');
    const doc_cert = document.querySelector('#doc_cert');
    const court_cert = document.querySelector('#court_cert');

    name_of_parent.disabled = true;
    name_of_sibling.disabled = true;
    death_cert.disabled = true;
    immediate_family_member.disabled = true;
    doc_cert.disabled = true;
    court_cert.disabled = true;

    reason.forEach((button) => {
    button.addEventListener("change", () => {
        if (button.value === "Filial Obligations") {
            filial.style.display = "block";
            death_anniversary.style.display = "none";
            ante_mortem.style.display = "none";
            court_attendance.style.display = "none";
            document.getElementById("parent").disabled = false; //radio buttons
            document.getElementById("sibling").disabled = false; //radio buttons
            name_of_parent.disabled = false;
            name_of_sibling.disabled = false;
            death_cert.disabled = true;
            immediate_family_member.disabled = true;
            doc_cert.disabled = true;
            court_cert.disabled = true;
            choice.forEach((button) => {
            button.addEventListener("change", () => {
                if (button.value === "parent") {
                    choice1.style.display = "block";
                    choice2.style.display = "none";
                    name_of_parent.disabled = false;
                    name_of_sibling.disabled = true;
                } else {
                    choice1.style.display = "none";
                    choice2.style.display = "block";
                    name_of_parent.disabled = true;
                    name_of_sibling.disabled = false;
                }
                })
            });

        }

        else if (button.value === "Family Reunion") {
            filial.style.display = "none";
            death_anniversary.style.display = "none";
            ante_mortem.style.display = "none";
            court_attendance.style.display = "none";
            document.getElementById("parent").disabled = true; //radio buttons
            document.getElementById("sibling").disabled = true; //radio buttons
            name_of_parent.disabled = true;
            name_of_sibling.disabled = true;
            death_cert.disabled = true;
            immediate_family_member.disabled = true;
            doc_cert.disabled = true;
            court_cert.disabled = true;
        }

        else if (button.value === "Death Anniversary") {
            filial.style.display = "none";
            death_anniversary.style.display = "block";
            ante_mortem.style.display = "none";
            court_attendance.style.display = "none";
            death_cert.disabled = false;
            name_of_parent.disabled = true;
            name_of_sibling.disabled = true;
            immediate_family_member.disabled = true;
            doc_cert.disabled = true;
            court_cert.disabled = true;
            document.getElementById("parent").disabled = true; //radio buttons
            document.getElementById("sibling").disabled = true; //radio buttons
        }

        else if (button.value === "Ante-mortem Activities") {
            filial.style.display = "none";
            death_anniversary.style.display = "none";
            ante_mortem.style.display = "block";
            court_attendance.style.display = "none";
            death_cert.disabled = true;
            name_of_parent.disabled = true;
            name_of_sibling.disabled = true;
            immediate_family_member.disabled = false;
            doc_cert.disabled = false;
            court_cert.disabled = true;
            document.getElementById("parent").disabled = true; //radio buttons
            document.getElementById("sibling").disabled = true; //radio buttons
        }

        else if (button.value === "Attendance in court hearings") {
            filial.style.display = "none";
            death_anniversary.style.display = "none";
            ante_mortem.style.display = "none";
            court_attendance.style.display = "block";
            death_cert.disabled = true;
            name_of_parent.disabled = true;
            name_of_sibling.disabled = true;
            immediate_family_member.disabled = true;
            doc_cert.disabled = true;
            court_cert.disabled = false;
            document.getElementById("parent").disabled = true; //radio buttons
            document.getElementById("sibling").disabled = true; //radio buttons
        }
        });
    });

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

    filial.style.marginLeft="5%"
    ante_mortem.style.marginLeft="5%"
    death_anniversary.style.marginLeft="5%"
    court_attendance.style.marginLeft="5%"

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

        if (weekdays>=5) {

        } else {
            event.preventDefault();
            alert("Must be at least 5 working days to apply for a Compassionate time-off");
            return false;
        }

        document.getElementById("myInput").value = weekdays2;

        // Display the result in the HTML page
        // const resultElement = document.getElementById("result");
        // resultElement.innerHTML = `Weekdays: ${weekdays}, Holidays: ${holidays}`;
      }

</script>



@endsection
