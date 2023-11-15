<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordering by Voice </title>
    <!-- Add the Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <div class="jumbotron">
        <h1 class="display-4">Ordering by Voice </h1>
        <p class="lead">Click "Start Recording"</p>
        <button class="btn btn-primary" onclick="startSpeechRecognition()">Start Recording</button>
        <button class="btn btn-danger" onclick="stopSpeechRecognition()">Stop Recording</button>

        <form id="order" action="{{route('send_transcript')}}" method="post" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="transcript">Transcript : </label>
                <input type="text" id="transcript" name="transcript" class="form-control" readonly>
            </div>
        </form>
    </div>

    <script>
        let recognition;
        let submissionTimeout;

        function startSpeechRecognition() {
            recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();

            recognition.lang = 'en-US';
            recognition.interimResults = true;
            recognition.continuous = true;

            recognition.onresult = function (event) {
                let finalTranscript = '';

                for (let i = event.resultIndex; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript + ' ';

                        recognition.stop();

                        document.getElementById('transcript').value = finalTranscript;

                        submissionTimeout = setTimeout(submitForm, 3000);
                    }
                }
            };

            recognition.onend = function () {
                // document.getElementById('order').submit();
            };

            recognition.onerror = function (event) {
                console.error('Speech error:', event.error);
            };

            recognition.start();
        }

        function stopSpeechRecognition() {
            if (recognition) {
                recognition.stop();
                clearTimeout(submissionTimeout);
            }
        }

        function submitForm() {
            document.getElementById('order').submit();
        }
    </script>

    <!-- Add the Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
