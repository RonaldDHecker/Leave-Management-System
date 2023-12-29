@extends('layouts.app')

@section('content')

<div class="row">
    
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div class="col-4">
                        <h1 class="card-title" style="font-size: 20px">HRDS-PAD Form No. 08</h1>
                    </div>
            
                    <div class="col-8">
                        <h1 class="card-title" style="font-size: 20px">APPLICATION FOR AVAILMENT OF COMPENSATORY TIME-OFF (CTO)</h1>
                    </div>
                </div>
                
                <form class="needs-validation">
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
                        <div class="col-md">
                            <label for="number_hours" class="col-md col-form-label">Number of Hours Applied for:</label>
                            <input type="text" class="form-control" id="number_hours" name="number_hours"
                                    placeholder="Must be in blocks of four (4) or eight (8) hours." required >
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                        </div>
                        <div class="col-md">
                        <label for="date2" class="col-md col-form-label">Start Date</label>
                            <input class="form-control" type="date" value="" id="date2" name="date2">
                        </div>

                        <div class="col-md">
                            <label for="date3" class="col-md col-form-label">Finish Date</label>
                                <input class="form-control" type="date" value="" id="date3" name="date3">
                        </div>
                    </div>
                    
                    
                    <input type="text" id="myInput" name="leave_days" hidden>

                    <div class="mb-3">
                        <button onclick="calculateWeekdaysAndHolidays()" class="btn btn-primary" type="submit" value="submit">Submit form</button>
                    </div>

                    

                    
                        <label for="instructions" class="form-label">Instructions:</label>
                        <p>
                            1.	The CTO may be availed of in blocks of four (4) or eight (8) hours.
                        </p>
                        <p>
                            2.	The employee may use the CTO continuously up to a maximum five (5) consecutive days per single availment, or on staggered basis within the year.
                        </p>
                        <p>
                            3.	The employee must first obtain approval from the head of office regarding the schedule of availment of CTO.
                        </p>
                        <p>
                            4.	Attach approved Certificate of COC Earned (prescribed form under Joint CSC-DBM Circular No. 2, series of 2004) for validation purposes.
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

        if (weekdays>=5) {
            
        } else {
            event.preventDefault();
            alert("Must be at least 5 working days to apply for a Compensatory Time-off");
            return false;
        }

        document.getElementById("myInput").value = weekdays2;

        // Display the result in the HTML page
        // const resultElement = document.getElementById("result");
        // resultElement.innerHTML = `Weekdays: ${weekdays}, Holidays: ${holidays}`;
        }
    
</script>



@endsection