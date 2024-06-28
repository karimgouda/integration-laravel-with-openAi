@extends('layouts.master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .form-section {
            padding: 50px 0;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
        }
    </style>
@endpush

@section('content')
    <div class="form-section">
        <div class="container">
            <div class=" bg-light p-5 rounded">
                <h2 class="text-center mb-4">
                    Ask To Gouda Ai
                    <i class="fa-brands fa-rocketchat mx-1"></i>
                </h2>
                <form method="POST" action="{{route('posts.generateGptText')}}">
                    @csrf
{{--                    <div class="mb-3">--}}
{{--                        <label for="title" class="form-label">Post Title</label>--}}
{{--                        <input type="text" class="form-control" id="title" value="{{old('title')}}" name="title" required>--}}
{{--                    </div>--}}
                    <div class="mb-3">
                        <label for="content" class="form-label">ChatGpt Prompt</label>
                        <textarea class="form-control" id="gptPromptBox" name="gpt_content" rows="5">{{old('gpt_content')}}</textarea>
                        <p><a id="generateArticle" href="">Execute Prompt</a></p>
                        <div id="errorMessage" class="text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="post-content" class="form-label">Content</label>
                        <textarea class="form-control" id="post-content" name="content" rows="5">{{old('content')}}</textarea>
                    </div>
{{--                    <button type="submit" class="btn btn-primary w-100">Create Post</button>--}}
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#post-content'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const generateArticleButton = document.getElementById('generateArticle');
            generateArticleButton.addEventListener('click', function(e){
                e.preventDefault();
                const prompt = document.getElementById('gptPromptBox').value;

                // check if the prompt empty
                if(!prompt.trim()){
                    let errorMessage  = document.getElementById('errorMessage');
                    errorMessage.textContent = 'You must provide a prompt';
                    errorMessage.style.display = "block";
                    return;
                }

                //change the button text to show that it's working
                generateArticleButton.textContent = "Working on it....";
                fetch('/posts/generateGptText',{
                    method: 'POST',
                    body: JSON.stringify({prompt:prompt}),
                    headers: {
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                }).then(response=>{
                    if(!response.ok){
                        throw new Error('NetWork response was not ok');
                    }
                    return response.json();
                }).then(data=>{
                    generateArticleButton.textContent = "Execute Prompt";
                    if(data.error){
                        let errorMessage  = document.getElementById('errorMessage');
                        let customMessage;
                        if(data.errorCode){
                            switch (data.errorCode){
                                case 'invalid_api_key':
                                    customMessage = 'Incorrect Api Key';
                                    break;
                                case 'context_length_exceeded':
                                    customMessage = 'Prompt too long';
                                    break;
                                default:
                                    customMessage = "Unexpected Error , tray Again";
                            }
                        }else {
                            switch (data.errorType){
                                case 'invalid_request_error':
                                    customMessage = 'Request Invalid';
                                    break;
                                case 'insufficient_quota':
                                    customMessage = 'Quota Exceeded';
                                    break;
                                default:
                                    customMessage = "Unexpected Error , tray Again";
                            }
                        }

                        errorMessage.textContent = customMessage;
                        errorMessage.style.display = "block";
                    }else {
                        document.querySelector('#post-content').textContent = data.completion;
                        document.getElementById('errorMessage').style.display = "none";
                    }
                }).catch((error)=>{
                    generateArticleButton.textContent = 'Execute Prompt';
                    console.error('Error',error);
                   let errorMessage =  document.getElementById('errorMessage');
                    errorMessage.textContent = "Unexpected Error , tray Again";
                    errorMessage.style.display = "block";
                })

            })
        })
    </script>


@endpush
