document.addEventListener('DOMContentLoaded', function() {
    let mediaRecorder;
    let chunks = [];
    let timerInterval;
    let seconds = 0;
    let stream;
    let startTime;
    let endTime;

    const startRecording = async () => {
        try {
            const displayMediaOptions = {
                video: {
                    displaySurface: 'browser',
                    logicalSurface: true,
                    cursor: 'never'
                },
                audio: true,
            };

            stream = await navigator.mediaDevices.getDisplayMedia(displayMediaOptions);

            mediaRecorder = new MediaRecorder(stream, { mimeType: 'video/webm' });

            mediaRecorder.ondataavailable = event => {
                if (event.data.size > 0) {
                    chunks.push(event.data);
                }
            };

            mediaRecorder.onstart = () => {
                startTime = new Date().toLocaleString();
                showRecordingIndicator();
                document.getElementById('stopButton').disabled = false;
                document.getElementById('startButton').disabled = true;
            };

            mediaRecorder.onstop = () => {
                stopTimer();
                endTime = new Date().toLocaleString();
                const blob = new Blob(chunks, { type: 'video/webm' });
                const name = document.getElementById('nameInput').value || 'Unknown';
                const taskInfo = document.getElementById('taskInput').value || 'No Task Information';
                const uniqueFileName = `${name}_${Date.now()}.webm`;

                const userId = document.getElementById('user_id').value || '';

                const project_id = document.getElementById('projectSelect').value || '';

                saveVideoData({ name, taskInfo, project_id: project_id, startTime, endTime, totalTime: seconds, uniqueFileName, user_id: userId });
                uploadChunks(blob, uniqueFileName);
                resetRecording();
                document.getElementById('stopButton').disabled = true;
                document.getElementById('startButton').disabled = false;
            };

            mediaRecorder.start();
            startTimer();
        } catch (err) {
            console.error('Error accessing screen capture:', err);
        }
    };

    const stopRecording = () => {
        if (mediaRecorder && mediaRecorder.state !== 'inactive') {
            mediaRecorder.stop();
        }
    };

    const uploadChunks = (blob, fileName) => {
        const formData = new FormData();
        formData.append('video', blob, fileName);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', AppURL+'api/task-vedio-uploader', true);

        xhr.upload.onprogress = (event) => {
            if (event.lengthComputable) {
                const percentComplete = (event.loaded / event.total) * 100;
                setTimeout(() => {
                    document.getElementById('progressBar').value = percentComplete;
                }, 2000);
            }
        };

        xhr.onload = () => {
            if (xhr.status === 200) {
                console.log('Upload successful:', xhr.responseText);
            } else {
                console.error('Upload failed. Status:', xhr.status);
            }
        };

        xhr.onerror = () => {
            console.error('Upload error:', xhr.statusText);
        };

        xhr.send(formData);
    };

    const startTimer = () => {
        timerInterval = setInterval(() => {
            seconds++;
            updateTimer();
        }, 1000);
    };

    const stopTimer = () => {
        clearInterval(timerInterval);
    };

    const updateTimer = () => {
        const minutes = Math.floor(seconds / 60);
        const remainderSeconds = seconds % 60;
        document.getElementById('timer').innerText = `${minutes < 10 ? '0' : ''}${minutes}:${remainderSeconds < 10 ? '0' : ''}${remainderSeconds}`;
    };

    const saveVideoData = (videoData) => {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', AppURL+'api/task-handler', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = () => {
            if (xhr.status === 201) {
                console.log('Task created successfully');
                window.alert('Task Created Successfully');
                window.location.href=AppURL + 'dashboard/user?msg=Task Created';
            } else {
                console.error('Error creating task:', xhr.responseText);
            }
        };

        xhr.onerror = () => {
            console.error('Network error');
        };

        xhr.send(JSON.stringify(videoData));
    };

    const showRecordingIndicator = () => {
        const indicator = document.getElementById('recordingIndicator');
        indicator.style.display = 'block';
        indicator.style.animation = 'blink 1s infinite';
    };

    const resetRecording = () => {
        chunks = [];
        seconds = 0;
        updateTimer();
        const indicator = document.getElementById('recordingIndicator');
        indicator.style.animation = 'none';
        indicator.style.display = 'none';
        stream.getTracks().forEach(track => track.stop());
    };

    document.getElementById('startButton').addEventListener('click', startRecording);
    document.getElementById('stopButton').addEventListener('click', stopRecording);
});
