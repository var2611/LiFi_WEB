// Hide submenus
// $('#body-row .collapse').collapse('shown');

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left');

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function () {
    SidebarCollapse();
});

// $('#contract_start_month').datepicker( {
//     format: "mm-yyyy",
//     viewMode: "months",
//     minViewMode: "months"
// });

function SidebarCollapse() {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');

    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if (SeparatorTitle.hasClass('d-flex')) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }

    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}

function GetDays() {
    var dropdt = new Date(document.getElementById("end_date").value);
    var pickdt = new Date(document.getElementById("start_date").value);
    return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
}

function cal() {
    if (document.getElementById("end_date")) {
        document.getElementById("days").value = GetDays();
    }
}

function GetABDays(){
    var ttDays = parseInt(document.getElementById("total_days").value);
    var pDays = parseInt(document.getElementById("present_days").value);

    var old_pDays = document.getElementById("present_days").defaultValue;
    var old_aDays = document.getElementById("absent_days").defaultValue;
    console.log("Saving id " + old_pDays);
    console.log("Saving pDays " + pDays);
    console.log("Saving ttDays " + ttDays);

    if (pDays <= ttDays) {
        return parseInt(ttDays - pDays);
    }
    alert('Present Days can not be grater than Total Days')
    document.getElementById("present_days").value = old_pDays;
    return parseInt(old_aDays);
}

function calculateABDays(){
    if (document.getElementById("total_days") && document.getElementById("absent_days")) {
        document.getElementById("absent_days").value = GetABDays();
    }
}

function calculateSalary(){
    var salary_basic = parseFloat(document.getElementById("salary_basic").value) || 0;
    var salary_hra = parseFloat(document.getElementById("salary_hra").value) || 0;
    var salary_pf = parseFloat(document.getElementById("salary_pf").value) || 0;
    var salary_advance = parseFloat(document.getElementById("salary_advance").value) || 0;

    var old_salary_basic = parseFloat(document.getElementById("salary_basic").defaultValue);
    var old_salary_hra = parseFloat(document.getElementById("salary_hra").defaultValue);
    var old_salary_pf = parseFloat(document.getElementById("salary_pf").defaultValue);
    var old_salary_advance = parseFloat(document.getElementById("salary_advance").defaultValue);

    var salary_total = salary_basic + salary_hra;
    var salary_gross_earning = salary_total - salary_pf;
    var salary_gross_deduction = salary_pf + salary_advance;
    var salary_net_pay = salary_total - salary_gross_deduction;

    document.getElementById("salary_total").value = salary_total;
    document.getElementById("salary_gross_earning").value = salary_gross_earning;
    document.getElementById("salary_gross_deduction").value = salary_gross_deduction;
    document.getElementById("salary_net_pay").value = salary_net_pay;
    document.getElementById("salary_basic").value = salary_basic;
    document.getElementById("salary_hra").value = salary_hra;
    document.getElementById("salary_pf").value = salary_pf;
    document.getElementById("salary_advance").value = salary_advance;

}

async function getContractDetail() {
    jQuery(".loader").show();
    if (document.getElementById("emp_contract_type_id")) {

        var contract_type_id = document.getElementById('emp_contract_type_id').options[document.getElementById('emp_contract_type_id').selectedIndex].value
        // alert(parseInt(contract_type_id));
        var user_id = document.getElementsByName('user_id')[0].value;

        let url = "{{ route('edit-emp-contract', ':id', ':user_id') }}";
        url = url.replace(':id', contract_type_id);
        url = url.replace(':user_id', user_id);

        // alert((APP_URL));
        await sleep(2000)
        $('#details').load(APP_URL + '/edit-emp-contract/' + contract_type_id + '/' + user_id);
        // document.location.href=url;
    }

    jQuery(".loader").hide();
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}





