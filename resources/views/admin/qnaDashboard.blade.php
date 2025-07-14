@extends('layout/admin-layout')

@section('space-work')
    <h2 class="mb-4">Questions & Answers</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQnamodal">
        Add Q&A
    </button>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importQnamodal">
        Import Q&A
    </button>

    <table class="table">
        <thead>
            <th>#</th>
            <th>Question</th>
            <th>Answers</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
            @if(count($questions) > 0)
                @foreach($questions as $question)
                <tr>
                    <td> {{ $question->id }} </td>
                    <td> {{ $question->question }} </td> 
                    <td>
                        <a href="#" class="ansButton" data-id="{{ $question->id }}" data-toggle="modal" data-target="#showAnsModal">
                            See answers
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-info editButton" data-id="{{ $question->id }}" data-toggle="modal" data-target="#editQnaModal">
                            Edit
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger deleteButton" data-id="{{ $question->id }}" data-toggle="modal" data-target="#deleteQnaModal">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Questions & Answers not found!</td>
                </tr>
            @endif
        <tbody>

        </tbody>
    </table>
    <!-- Add Exam Modal -->
    <div class="modal fade" id="addQnamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> Add Q & A</h5>
                    <button id="addAnswer" class="ml-5 btn btn-info">Add Answer</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addQna">
                    @csrf
                    <div class="modal-body addQA">
                        <div class="row">
                            <div class="col">
                                <label for="question">Question</label>
                                <input type="text" class="w-100" name="question" placeholder="Enter question" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="error" style="color:red;"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addQuestion">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Show Ans Modal -->
<div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Show Answers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Answers</th>
                        <th>Correct ans</th>
                    </thead>
                    <tbody class="showAnswers">
                        
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <span class="error" style="color:red;"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- Edit Ans Modal -->
    <div class="modal fade" id="editQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> Update Q & A</h5>
                    <button id="addEditAnswer" class="ml-5 btn btn-info">Add Answer</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editQna">
                    @csrf
                    <div class="modal-body editModalAnswers">
                        <div class="row">
                            <div class="col">
                                <label for="question">Question</label>
                                <input type="text" class="w-100" name="question" id="question" placeholder="Enter question" required>
                                <input type="hidden" name="question_id" id="question_id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="editError" style="color:red;"></span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
     <!-- Delete Q&A Modal -->
    <div class="modal fade" id="deleteQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">  
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Q&A</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form id="deleteQna">
                      @csrf
                    <div class="modal-body">
                      <input type="hidden" name="delete_id" id="delete_qna_id">
                        <p>Are you sure you want to delete this question including answers?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
            </div>
    </div>

       <!-- Import Q&A Modal -->
    <div class="modal fade" id="importQnamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">  
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Import Q&A</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form id="importQna" enctype="mulipart/form-data">
                      @csrf
                    <div class="modal-body">

                      <input type="file" name="file" id="fileupload" required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms.excel">
                        <p>Are you sure you want to Import this file including questions and answers?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
            </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            // var answerCount = 0;

            // Add question and answers
            $("#addQna").submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                if ($(".answers").length  < 2) {
                    $(".error").text("Please add minimum two answers.");
                    setTimeout(function () {
                        $(".error").text("");
                    }, 2000);
                }else {
                    var checkIsCorrect = false;
                    for(let i =0; i < $(".is_correct").length; i++){
                        if( $(".is_correct:eq("+i+")").prop('checked') == true){
                            checkIsCorrect =  true;
                            $(".is_correct:eq("+i+")").val( $(".is_correct:eq("+i+")").next().find('input').val());

                        }

                    }

                    if(checkIsCorrect){
                       var formData = $(this).serialize();

                       $.ajax({
                        url:"{{ route('addQna') }}",
                        type:"POST",
                        data:formData,
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }
                          },
                        error: function(xhr, status, error) {
                                // Handle AJAX errors, e.g., display a generic error message
                                console.log(xhr);
                                console.log(status);
                                console.log(error);
                                alert("An error occurred while processing your request.");
                          }
                       });
                    }else{
                        $(".error").text("Please select any.");
                        setTimeout(function () {
                            $(".error").text("");
                        }, 2000);
                    }
                    // Form submission logic
                    // You can add your logic to submit the form here
                    // For example: $(this).submit();
                }
               
            });

            // Add answers
            $("#addAnswer").click(function () {

                if ($(".answers").length >= 6) {
                    $(".error").text("You can add maximum six answers.");
                    setTimeout(function () {
                        $(".error").text("");
                    }, 2000);
                }else{
                    var html = `
                    <div class="row mt-2 answers">
                        <input type="radio" name="is_correct" class="is_correct" >
                        <div class="col">
                            <input type="text" class="w-100" name="answers[]" placeholder="Enter answer" required>
                        </div>
                        <button class="bt btn-danger remove-answer">Remove</button>
                    </div>
                    `;

                    $(".addQA").append(html);
                }
               // answerCount++;
            });
            // for working remove button 
            $(".addQA").on("click", ".remove-answer", function () {
                $(this).closest(".row.answers").remove();
               // answerCount--;
            });

            // show answers
            $(".ansButton").click(function(){

                var questions = @json($questions);
                var qid = $(this).attr('data-id');
                console.log(questions);
                var html = '';
                //console.log(questions);
                for(let i = 0; i< questions.length; i++){
                    if(questions[i]['id'] == qid){
                        
                        var ansLength=questions[i]['answers'].length;
                        //console.log(ansLength);
                        for(let j=0; j<ansLength; j++){
                            let is_correct = 'No';
                            if(questions[i]['answers'][j]['is_correct'] == 1){
                                is_correct = 'Yes';
                            }
                            html += `
                            <tr>
                                <td> ${(j+1)}</td>
                                <td>${questions[i]['answers'][j]['answer']}</td>
                                <td>${is_correct}</td></tr>
                            `;
                            }
                        break;
                    }
                }

                $('.showAnswers').html(html);
             });


            
            });

           // Edit/update Q & A pop-up
            $("#addEditAnswer").click(function () {
                //var len= $(".editAnswers").length
                console.log($(".editAnswers").length);
                if ($(".editAnswers").length >= 6) {
                    $(".editError").text("You can add a maximum of six answers.");
                    setTimeout(function () {
                        $(".editError").text("");
                    }, 5000);
                } else {
                    var html = `
                    <div class="row mt-2 editAnswers">
                        <input type="radio" name="is_correct" class="edit_is_correct" required>
                        <div class="col">
                            <input type="text" class="w-100" name="new_answers[]" placeholder="Enter answer" required>
                        </div>
                        <button class="bt btn-danger remove-answer">Remove</button>
                    </div>
                    `;

                    $(".editModalAnswers").append(html);
                }
                
            });
            // for working remove button 
            $(".editModalAnswers").on("click", ".remove-answer", function () {
                $(this).closest(".row.editAnswers").remove();
              //  answerCount--;
            });
            // Getting question and answers and place in pop up
            $(".editButton").click(function(){
                    var qid = $(this).attr('data-id');
                    console.log($(".editAnswers").length);
                    $.ajax({
                        url:"{{ route('getQnaDetails') }}",
                        type:"GET",
                        data:{qid:qid},
                        success:function(data){
                            

                             var qna = data.data;
                            
                             $("#question_id").val(qna['id']);
                             $("#question").val(qna['question']);
                             $(".editAnswers").remove();
                             var html = ``;

                             for(let i =0; i<qna['answers'].length; i++){
                                var checked = ``;
                                if(qna['answers'][i]['is_correct']==1){
                                    checked = 'checked';
                                    //console.log(qna['answers'][i]['is_correct']);
                                }
                                //console.log(qna['answers'][i]['answer']);
                                html += `
                                <div class="row mt-2 editAnswers">
                                    <input type="radio" name="is_correct" class="edit_is_correct" ${checked} required>
                                    <div class="col">
                                        <input type="text" class="w-100" name="answers[${qna.answers[i].id}]" placeholder="Enter answer"
                                        value="${qna.answers[i].answer}" required>
                                    </div>
                                    <button type="button" class="bt btn-danger removeButton removeAnswer" data-id="${qna['answers'][i]['id']}">Remove</button>
                                </div>
                                `;
                             }
                             //$(".editModalAnswers").html(html);
                             $(".editModalAnswers").append(html);
                        }
                    });
            });

                // Updated Form submitting
            $("#editQna").submit(function (e) {
                    e.preventDefault();
                    if ($(".editAnswers").length < 2) {  // Correct the condition
                        $(".editError").text("Please add at least two answers.");
                        setTimeout(function () {
                            $(".editError").text("");
                        }, 2000);
                    } else {
                        var checkIsCorrect = false;
                        for (let i = 0; i < $(".edit_is_correct").length; i++) {
                            if ($(".edit_is_correct:eq(" + i + ")").prop('checked') == true) {
                                checkIsCorrect = true;
                                $(".edit_is_correct:eq(" + i + ")").val($(".edit_is_correct:eq(" + i + ")").next().find('input').val());
                            }
                        }
                       // console.log(checkIsCorrect);
                        if (checkIsCorrect) {
                           // console.log("working");
                            var formData = $(this).serialize();
                            console.log(formData);
                            $.ajax({
                                url: "{{ route('updateQna') }}",
                                type: "POST",
                                data: formData,
                                dataType: "json",
                                success: function(data) {
                                    console.log(data);
                                    if (data.success == true) {
                                        location.reload();
                                    } else {
                                        alert(data.msg);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // Handle AJAX errors, e.g., display a generic error message
                                    console.log(xhr);
                                    alert("An error occurred while processing your request.");
                                }
                            });
                        } else {
                            $(".editError").text("Please select a correct answer.");
                            setTimeout(function () {
                                $(".editError").text("");
                            }, 2000);
                        }
                    }
            });

            
            // Remove Answers
            $(document).on('click', '.removeAnswer', function(){
            // e.preventDefault();
                var answerId = $(this).attr('data-id');
                var button = $(this);
                //alert(answerId);
                $.ajax({
                    url: "{{ route('deleteAns') }}",
                    type: "GET",
                    data: {id:answerId},
                    success:function(data){
                        if(data.success == true){
                            console.log(data.msg);
                            button.closest(".row.editAnswers").remove();
                        }else{
                            alert(data.msg);
                        }
                    }
                });
                
            });

            $('.deleteButton').click(function(){
                var id =$(this).attr('data-id');
                $('#delete_qna_id').val(id);
            });

            $('#deleteQna').submit(function(e){
                e.preventDefault();
                var formData = $(this).serialize();
                console.log(formData);
                $.ajax({
                    url: "{{route('delete_Qna')}}",
                    type: "POST",
                    data: formData,
                    success:function(data){
                        
                        if(data.success == true){
                            location.reload();

                        }else{
                            alert(data.msg);
                        }
                    }
                })
            });

            // Import Q&A
            $('#importQna').submit(function(e){
                e.preventDefault();
                let formData = new FormData();
                formData.append("file",fileupload.files[0]);
                $.ajaxSetup({
                    headers :{
                        "X-CSRF-TOKEN": " {{ csrf_token() }} "
                    }
                })
                console.log(formData);
                $.ajax({
                    url: "{{route('importQna')}}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        console.log(data);
                        if(data.success == true){
                            location.reload();

                        }else{
                            alert(data.msg);
                        }
                    }
                })
            });
    </script>
@endsection
