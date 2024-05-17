<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <style>
        body{
            background-color: #00007c;
        }
        .mandatory:after{
              content:'*';
              color:red;
        }
        label{
            margin-top: 2%;
            color: aliceblue;
        }
        .form_div{
            background: #0d4fb4;
        }
        .ui-datepicker {
    background: skyblue;
    border: 1px solid #555;
    color: #EEE;
}
    </style>
</head>
<body>
    <div class="container-fluid mt-5">
        <p class="text-info text-center h3 text-uppercase">Manpower form</p>
        <form action="" method="post" id="myform">
        <div class="container mt-4 card p-3 form_div">
            <div class="row">
                <div class="col-sm-6">
                    <input type="text" id="id" name="id" class=""hidden>
                    <label for="name" class="form-label mandatory">Name</label>
                    <input type="text" id="name" name="name" class="form-control text_only" required>
                </div>
                <div class="col-sm-6">
                    <label for="dob" class="form-label mandatory">Date Of Birth</label>
                    <input type="date" id="dob"  name="dob" class="form-control"required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label for="skil" class="form-label mandatory">Skill</label>
                    <select id="skill" name="skill" class="form-select">
                        <option value="">--Select Skill--</option>
                        <?php
                        require_once'db.php';
                        $select="select * from mst_skillsets";
                        $result=pg_query($select);
                        if(pg_num_rows($result)>0){
                            while($row=pg_fetch_assoc($result)){
                                $sid=$row['sid'];
                                $skillset=$row['skillset'];
                                echo"<option value='$sid'>$skillset</option>";
                            }
                        }
                        ?>
                    </select>    
                </div>
                <div class="col-sm-6">
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address" name="address" class="form-control" cols="30" rows="2" </textarea></textarea>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label for="mobile" class="form-label mandatory">Mobile No</label>
                    <input type="text" maxlength="10" id="mobile" name="mobile" class="form-control Numbers_Only Mobile_Validation">
                </div>
                <div class="col-sm-6">
                    <label for="email" class="form-label mandatory">Email</label>
                    <input type="text" id="email" name="email" class="form-control Email_Validation" required>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    <label for="remarks" class="form-label">Remarks</label>
                    <input type="text" id="remarks" name="remarks" class="form-control">
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-warning" id="submit" type="button" style="margin-top:8%;">Submit</button>
                    <button class="btn btn-danger" id="update" type="button" style="margin-top:8%;display:none;">Update</button>

                </div>
            </div>

        </div>
        </form>
    </div>

    <div class="data_table container bg-light" id="data_table" style="margin-top: 10%;">
        <table class="table table-striped">
            <tr><th>Manid</th>
            <th>Name</th>
            <th>Date of birth</th>
            <th>Skill Code</th>
            <th>Email</th>
            <th>Mobie No</th>
            <th>Address</th>
            <th>Remarks</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </table>
        <script>
            $(document).ready(function(){
$.ajax({
    url:'fetch.php',
    method:'post',
    data:'json',
    success:function(response){

      var data=JSON.parse(response);
      for(i in data){
        
         $("table").append( 
          "<tr id='"+data[i].id+"'><td>"+data[i].id+"</td>"
            +"<td>"+data[i].name+"</td>"
            +"<td>" +data[i].dob+"</td>"
            +"<td>" +data[i].skill+"</td>"
             +"<td>"+data[i].email+"</td>"
             +"<td>" +data[i].mobile+"</td>"  
             +"<td>" +data[i].address+"</td>" 
             +"<td>" +data[i].remarks+"</td>"  
             +"<td>" +'<i class="fas fa-pen text-warning" id="edit"></i>'+"</td>"  
             +"<td>" +'<i class="far fa-trash-alt text-danger remove" id="delete"></i>'+"</td></tr>"); 
            }
            
      }
    })
})

        </script>
    </div>
</body>

<script>
     $(document).on('keyup blur','.text_only',function(){
        $(this).val($(this).val().replace(/[^A-Za-z ]/g, ''));
    })
    $(document).on('keyup blur','.Numbers_Only',function(){
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    })
    
     $(document).on('blur','.Email_Validation',function(event){
        if(!$(this).val().match(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/)){
        alert('Enter valid mail address');
       
 }
     })

     $(document).on('blur','.Mobile_Validation',function(event){
        if (!$('.number').val().match('[6-9]{1}[0-9]{9}')) {
        alert('invalid')
        $(this).focus();
// throw {
//     message: "Invald Mobileno",
//     focus: ".number"
// }

}

else if ($('.number').val() === '6666666666' || $('.number').val() === '7777777777'
|| $('.number').val() === '8888888888' || $('.number').val() === '9999999999') {
    alert('invalid2')
        $(this).focus();
// throw {
//     message: "Repated Numbers not allowed",
//     focus: ".number"
// }
}
     })
     $(document).on('blur','.Mobile_Validatn',function(event){

var Field_Element_ID=$(this).attr('id');
if($(this).val()!='')
{
    var mobileno=$(this).val();
    var First_no=parseInt($(this).val().charAt(0));
    
    var Invalid_No=[0,1,2,3,4,5];
    var Invalid_Mobile_no=['6666666666','7777777777','8888888888','9999999999'];
    
    if ($.inArray(First_no, Invalid_No) != -1)
    {
        $('.Mail_id,input[type=submit]').attr('disabled','disabled');
        alert('Invalid Mobile Number');
        $('#'+Field_Element_ID).val('');
        setTimeout(function() {
        $('#'+Field_Element_ID).focus();
        $('.Mail_id,input[type=submit]').removeAttr('disabled');
        }, 1); 

    }
    else if(mobileno.length!=10)
    {
        $('.Mail_id,input[type=submit]').attr('disabled','disabled');
        alert('Invalid Mobile Number');
        $('#'+Field_Element_ID).val('');
        setTimeout(function() {
        $('#'+Field_Element_ID).focus();
        $('.Mail_id,input[type=submit]').removeAttr('disabled');
        }, 1); 
    }
    else if ($.inArray(mobileno, Invalid_Mobile_no) != -1)
    {
        $('.Mail_id,input[type=submit]').attr('disabled','disabled');
        alert('Invalid Mobile Number');
        $('#'+Field_Element_ID).val('');
        setTimeout(function() {
        $('#'+Field_Element_ID).focus();
        $('.Mail_id,input[type=submit]').removeAttr('disabled');
        }, 1); 
    }
}
else
{
   
}

});

// $(document).ready(function(){
//     $( "#dob" ).datepicker({
//         dateFormat: 'dd-mm-yy'
//     });
// })

// $(document).ready(function(){
// $.ajax({
//     url:'fetch.php',
//     method:'post',
//     data:'json',
//     success:function(response){

//       var data=JSON.parse(response);
//       for(i in data){
        
//          $("table").append( 
//           "<tr id='"+data[i].manid+"'><td>"+data[i].manid+"</td>"
//             +"<td>"+data[i].name+"</td>"
//             +"<td>" +data[i].date_of_birth+"</td>"
//             +"<td>" +data[i].skill_code+"</td>"
//              +"<td>"+data[i].email+"</td>"
//              +"<td>" +data[i].mobileno+"</td>"  
//              +"<td>" +data[i].address+"</td>" 
//              +"<td>" +data[i].remarks+"</td>"  
//              +"<td>" +'<i class="fas fa-pen text-warning" id="edit"></i>'+"</td>"  
//              +"<td>" +'<i class="far fa-trash-alt text-danger remove" id="delete"></i>'+"</td></tr>"); 
//             }
            
//       }
//     })
// })

$(document).ready(function(){
     
      $("#data_table").on('click','#delete',function(){
        var id = $(this).parents("tr").attr("id");


        if(confirm('Are you sure to remove this record ?'))
        { 
            $.ajax({
               url: 'delete.php',
               type: 'GET',
               data: {id: id},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).remove();
                    alert("Record removed successfully");  
               }
            });
       }
     });
});

$(document).ready(function(){
    $('#data_table').on('click','#edit',function(){
        var id = $(this).parents("tr").attr("id");

        if(confirm('Are you sure to edit this record ?'))
        { 
            $.ajax({
               url: 'edit.php',
               type: 'GET',
               data: {id: id},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(response) {
                 $('#submit').hide();
                 $('#update').css('display','block');
                var data=JSON.parse(response);
                for(i in data){
                   $('#id').val(data[i].id);
                   $('#name').val(data[i].name);
                   $('#dob').val(data[i].dob);
                   $('#skill').val(data[i].skill);
                   $('#address').val(data[i].address);
                   $('#mobile').val(data[i].mobile);
                   $('#email').val(data[i].email);
                   $('#remarks').val(data[i].remarks);

                }
                
    }
            });

       }

    })
})



$(document).ready(function(){
    $('#update').click(function(){
        $.ajax({
            url: 'update.php',
            type: 'post',
            dataType: 'json',
            data: $('#myform').serialize(),
            success: function(data) {
                alert("Record updated successfully");

                // Update the specific row in the table
                var rowId = data.id;
                var row = $('#' + rowId);
                row.find('td:eq(1)').text(data.name);
                row.find('td:eq(2)').text(data.dob);
                row.find('td:eq(3)').text(data.skill);
                row.find('td:eq(4)').text(data.email);
                row.find('td:eq(5)').text(data.mobile);
                row.find('td:eq(6)').text(data.address);
                row.find('td:eq(7)').text(data.remarks);

                // Reset form and hide the Update button
                $('#myform')[0].reset();  
                $('#submit').show();
                $('#update').hide();
            },
            error: function() {
                alert("Error occurred while updating record");
            }
        });
    });
});

// $(document).ready(function(){
//     $('#update').click(function(){
//         $.ajax({
//         url:'update.php',
//         type:'post',
//         dataType:'html',
//         data:$('#myform').serialize(),
//         success:function(s){
//             alert(s);
//           $('#myform')[0].reset();  
//           $('#submit').show();
//           $('#update').css('display','none');
//           var data=JSON.parse(s);
          
//                 for(i in data){
//                    $('#id').val(data[i].id);
//                    $('#name').val(data[i].name);
//                    $('#dob').val(data[i].dob);
//                    $('#skill').val(data[i].skill);
//                    $('#address').val(data[i].address);
//                    $('#mobile').val(data[i].mobile);
//                    $('#email').val(data[i].email);
//                    $('#remarks').val(data[i].remarks);

//                 }
// //         }
// //       })
      
//     })
// })


$(document).on('click', "#submit", function() {
    var Current_Field_id = $(this).attr('id');
    try {
        if ($("#name").val().length == '') {
            throw {
                msg: "Enter your name",
                foc: "#name"
            }
        }
        if ($("#dob").val().length == '') {
            throw {
                msg: "Enter your date of birth",
                foc: "#dob"
            }
        }

        var birthday = $('#dob').val();
        var optimizedBirthday = birthday.replace(/-/g, "/");
        var myBirthday = new Date(optimizedBirthday);
        var currentDate = new Date().toJSON().slice(0,10)+' 01:00:00';
        var myAge = ~~((Date.now(currentDate) - myBirthday) / (31557600000));

        if (myAge < 25 || myAge > 35) {
            throw {
                msg: 'Age should must be above 25-35 years',
                foc: '#dob'
            }
        }
        if ($("#skill").val().length == '') {
            throw {
                msg: "choose your skill",
                foc: "#skill"
            }
        }
        if ($("#mobile").val().length == '') {
            throw {
                msg: "Enter mobile number",
                foc: "#mobile"
            }
        }

        // Check for valid email
        if ($('#email').val().length == '') {
            throw {
                msg: 'Enter valid Email Address',
                foc: '#email'
            }
        }

        // Ajax request
        $.ajax({
            url: 'insert.php',
            type: 'post',
            dataType: 'json', // Expect JSON response
            data: $('#myform').serialize(),
            success: function(response) {
                if (response.success) {
                    alert(response.success); // Show success message
                    var data = response.data;
                    // Append new row to the table
                    $("table").append(
                        "<tr>" +
                        "<td>" + data.id + "</td>" +
                        "<td>" + data.name + "</td>" +
                        "<td>" + data.dob + "</td>" +
                        "<td>" + data.skill + "</td>" +
                        "<td>" + data.email + "</td>" +
                        "<td>" + data.mobile + "</td>" +
                        "<td>" + data.address + "</td>" +
                        "<td>" + data.remarks + "</td>" +
                        "<td><i class='fas fa-pen text-warning edit'></i></td>" +
                        "<td><i class='far fa-trash-alt text-danger remove'></i></td>" +
                        "</tr>"
                    );
                    $('#myform')[0].reset();
                } else {
                    alert(response.error); // Show error message
                }
            },
            error: function() {
                alert("An error occurred while processing your request.");
            }
        });
    } catch (e) {
        alert(e.msg);
        $(e.foc).focus();
    }
});


</script>
</html>