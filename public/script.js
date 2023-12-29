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

        if (weekdays <=5) {
            
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
      adoption.style.marginLeft="5%"
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
        const adoption_leave_attachment = document.querySelector('#adoption_leave_attachment'); //
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
        slb_leave_attachment.disabled = true;
        adoption_leave_attachment.disabled = true;
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
            adoption.style.display="none";
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
            adoption.style.display="none";
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
            adoption.style.display="none";
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
            adoption.style.display="none";
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
            adoption.style.display="none";
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
            document.getElementById("masters").disabled = false;      //StudyL radio buttons
            document.getElementById("exam").disabled = false;         //StudyL radio buttons

        } else if (button.value === "10-Day VAWC Leave"){
            vawc.style.display = "block";
            study.style.display= "none";
            solo.style.display = "none";
            vacation.style.display = "none";
            mandatory.style.display = "none";
            special.style.display="none";
            rehab.style.display = "none";
            slb.style.display = "none";
            adoption.style.display="none";
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
            adoption.style.display="none";
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
            adoption.style.display="none";
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
        } else if (button.value === "Adoption Leave"){
            adoption.style.display="block";
            slb.style.display = "none";
            rehab.style.display = "none";
            vawc.style.display = "none";
            study.style.display= "none";
            solo.style.display = "none";
            vacation.style.display = "none";
            mandatory.style.display = "none";
            special.style.display= "none";
            adoption_leave_attachment.disabled = false;
        } 
        })
    });
