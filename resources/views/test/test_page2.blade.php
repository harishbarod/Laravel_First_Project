@extends('layouts.app')
@section('content')
    <div class="container">

        <h2> Remaining Time : <span class="countdown"></span></h2>
        <div class="questions mt-4">

        </div>  
        <div class="button">
            <button class="btn btn-primary" id="prev" value="0">Prev</button>
            <button class="btn btn-primary" id="next" value="0">Next</button>
        </div>
    </div>

    


    <script>
        // saving every question answer
        $(document).ready(function() {
            // fetching all questions
            var prevButton = $('#prev').val();
            var nextButton = $('#next').val();

            if (prevButton == 0) {
                $("#prev").css("display", "none");
            } else {
                $("#prev").css("display", "block");
            }


            var submit_data = [];


            $(document).on('change', '.user_answer', function() {
                var user_answer = $('.user_answer:checked').val()
                // console.log(user_answer)
                var question_id = $('#question_id').val()
                var ind = submit_data.findIndex(x => x.question_id === question_id);


             var nextButton = $('#next').val();

                if (ind == nextButton) {
                    submit_data[nextButton]['user_answer'] = user_answer;
                } else {
                    if (!user_answer) {
                        user_answer = "";
                    }
                    submit_data.push({
                        user_answer: user_answer,
                        question_id: question_id
                    });

                }
           

});

            $(document).on('click', '#next', function() {
                var user_answer = $('.user_answer:checked').val()
                // console.log(user_answer)
                var question_id = $('#question_id').val()
                var ind = submit_data.findIndex(x => x.question_id === question_id);

                var prevButton = $('#prev').val();
                var nextButton = $('#next').val();
                if (submit_data.length > nextButton) {
                    var nextButton_new = parseInt(nextButton) + 1;
                    // console.log(nextButton_new)
                    // console.log(submit_data)
                } else {
                    var nextButton_new = parseInt(nextButton);
                    // console.log(nextButton_new)
                    // console.log(submit_data)
                }


                prevButton = parseInt(prevButton) + 1;
                nextButton = parseInt(nextButton) + 1;

                if (prevButton < 1) {
                    $("#prev").css("display", "none");
                } else {
                    $("#prev").css("display", "inline");
                }

                $('#prev').val(prevButton);
                $('#next').val(prevButton); 
                $.ajax({
                    url: "/test_questions",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(dataResult) {
                        var datas = dataResult[nextButton];
                        if (submit_data[nextButton_new]) {
                            var selected_answer = submit_data[nextButton_new]['user_answer'];
                        } else {
                            var selected_answer = null;
                            // console.log('null')
                        }


                        // console.log(selected_answer)
                        //    console.log(datas)


                       
                        if (dataResult.length <= nextButton + 1) {
                            $('#next').text('Submit')
                        }


                        if (dataResult.length >= nextButton + 1) {

                            var question =
                                `<h3>Q.${nextButton +1}  ${datas['question']}</h3>

                        <input type="hidden" id="question_id" name="question_id" value="${datas['id']}">
                        <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option1']}" ` + ((
                                    selected_answer == datas['option1']) ? 'checked' : '') +
                                ` >
                        <label for="answer" > <h4> (A) ${datas['option1']}</h4></label><br>

                     
                        <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option2']}"  ` + ((selected_answer == datas['option2']) ? 'checked' :
                                    '') +
                                `>
                        <label for="answer" > <h4> (B) ${datas['option2']}</h4></label><br>

                       
                        <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option3']}"  ` + ((
                                    selected_answer == datas['option3']) ? 'checked' : '') +
                                `>
                        <label for="answer" > <h4> (C) ${datas['option3']}</h4></label><br>

                        
                        <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option4']}" ` + ((selected_answer == datas['option4']) ? 'checked' :
                                '') + ` >
                        <label for="answer" > <h4> (D) ${datas['option4']}</h4></label><br>
                        `;
                            $('.questions').html(question);
                        } else {
                            $('#next').text('Next')
                        }
                    }

                });
                //  inserting data
                //    console.log(submit_data)
                if ($('#next').text() == 'Submit') {
                   if( confirm('Are you sure to submit the quiz ?')){

                     $(this).prop('disabled', true);
                    $.ajax({
                        url: "/Submitting_answers",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            submit_data: submit_data
                        },
                        success: function(dataResult) {
                            if (dataResult == 'success') {
                                window.location.href = "{{ url('quiz_result_new') }}";
                            }
                        }
                    })
                }
   
            }

            })
            //   on click prev button

            $(document).on('click', '#prev', function() {
                var prevButton = $('#prev').val();
                var nextButton = $('#next').val();
                nextButton = parseInt(nextButton) - 1;
                prevButton = parseInt(prevButton) - 1;
                     

                $('#next').val(nextButton);
                $('#prev').val(prevButton);

                //    button show condition
                if (prevButton == 0) {
                $("#prev").css("display", "none");
                } else {
                    $("#prev").css("display", "inline");
                }

                $.ajax({
                    url: "/test_questions",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(dataResult) {

                        if (dataResult.length == nextButton + 1) {
                            $('#next').text('Submit')
                        } else {
                            $('#next').text('Next')
                        }
                        var selected_answer = submit_data[prevButton]['user_answer']
                        var datas = dataResult[nextButton];
                        // console.log(selected_answer)
                        // console.log(datas)

                        var question = `<h3>Q.${prevButton+1}  ${datas['question']}</h3>

                        <input type="hidden" id="question_id" name="question_id" value="${datas['id']}">
                    <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option1']}"` +
                            ((selected_answer == datas['option1']) ? 'checked' : '') + ` >
                    <label for="answer" > <h4> (A) ${datas['option1']}</h4></label><br>

                 
                    <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option2']}" ` +
                            ((selected_answer == datas['option2']) ? 'checked' : '') + `   >
                    <label for="answer" > <h4> (B) ${datas['option2']}</h4></label><br>

                  
                    <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option3']}" ` +
                            ((selected_answer == datas['option3']) ? 'checked' : '') + `   >
                    <label for="answer" > <h4> (C) ${datas['option3']}</h4></label><br>

                    <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option4']}" ` +
                            ((selected_answer == datas['option4']) ? 'checked' : '') + `  >
                    <label for="answer" > <h4> (D) ${datas['option4']}</h4></label><br>
                    `;

                        $('.questions').html(question);


                    }

                });
            })


            //    prev button end


            $.ajax({
                url: "/test_questions",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(dataResult) {
                    var datas = dataResult[nextButton];

                    var question = `<h3>Q.${parseInt(nextButton)+1}  ${datas['question']}</h3>

                    <input type="hidden" id="question_id" name="question_id" value="${datas['id']}">
                    <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option1']}"  >
                    <label for="answer" > <h4> (A) ${datas['option1']}</h4></label><br>


                    <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option2']}"  >
                    <label for="answer" > <h4> (B) ${datas['option2']}</h4></label><br>


                    <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option3']}"  >
                    <label for="answer" > <h4> (C) ${datas['option3']}</h4></label><br>


                    <input type="radio" class="user_answer"  name="answer${nextButton}" value="${datas['option4']}"  >
                    <label for="answer" > <h4> (D) ${datas['option4']}</h4></label><br>
                    `;

                    $('.questions').append(question);


                }

            });

            var timer2 = "3:00";
            var interval = setInterval(function() {
            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) {
                clearInterval(interval);
                
                    // when timer end submitting the request 
                    $.ajax({
                            url: "/Submitting_answers",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                submit_data: submit_data
                            },
                            success: function(dataResult) {
                                if (dataResult == 'success') {
                                    window.location.href = "{{ url('quiz_result_new') }}";
                                }
                            }
                        })

                }
            seconds = (seconds < 0) ? 59 : seconds;
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
            }, 1000);
          


        });
      
    </script>
@endsection
