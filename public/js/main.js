// Hide submenus
// $('#body-row .collapse').collapse('shown');

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left');

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function () {
    SidebarCollapse();
});

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

async function getContractDetail() {
    jQuery(".loader").show();
    if (document.getElementById("emp_contract_type_id")) {

        var contract_type_id = document.getElementById('emp_contract_type_id').options[document.getElementById('emp_contract_type_id').selectedIndex].value
        // alert(parseInt(contract_type_id));
        var user_id = document.getElementsByName('user_id')[0].value;

        let url = "{{ route('emp-contract-edit', ':id', ':user_id') }}";
        url = url.replace(':id', contract_type_id);
        url = url.replace(':user_id', user_id);

        // alert((APP_URL));
        await sleep(2000)
        $('#details').load(APP_URL + '/emp-contract-edit/' + contract_type_id + '/' + user_id);
        // document.location.href=url;
    }

    jQuery(".loader").hide();
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}




