saveSingleData = (e) => {
    
    var values = [];
    
    var id = $(e).closest("tr").find(".id-value").text();
    var name = $(e).closest("tr").find(".name-value").text();
    var date = $(e).closest("tr").find('td input[type="date"]').val();
    var status = $(e).closest("tr").find('td:eq(3) input[type="radio"]:checked').val();
    
    values.push(id, name, date, status)

    $.ajax({
        url: '/attendance/save',
        type: 'POST',
        data: 
        {
            singleData: values,
        },
        dataType: 'json',
        success:function(response){
            window.location.href = "/attendance";
        },
        error: function(){
            alert('error!');
        }
    });
}

saveAllData = () => {
    var presentTableData = []
    var absentTableData = []

    $('#presentTable tr').each(function(row, tr) {
        presentTableData[row]={
            "employee_id" : $(tr).find('td:eq(0)').text(),
            "date" : $(tr).find('td:eq(2) input[type="date"]').val(),
            "working_status" : $(tr).find('td:eq(3) input[type="radio"]:checked').val()
        }
    });
    presentTableData.shift()

    $('#absentTable tr').each(function(row, tr) {
        absentTableData[row]={
            "employee_id" : $(tr).find('td:eq(0)').text(),
            "date" : $(tr).find('td:eq(2) input[type="date"]').val(),
            "working_status" : $(tr).find('td:eq(3) input[type="radio"]:checked').val()
        }
    });

    if (absentTableData.length !== 0 && !absentTableData[0].employee_id && !absentTableData[0].date) {
        absentTableData.shift()
    }

    absentTableData.map(data => {
        presentTableData.push(data)
    })

    $.ajax({
        url: '/attendance/saveall',
        type: 'POST',
        data: 
        {
            tableData: presentTableData
        },
        dataType: 'json',
        success:function(response){
            console.log(response)
        },
        error: function(err){
            alert('error!');
        }
    });

}