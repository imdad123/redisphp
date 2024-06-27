<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button id="ratelimit">Send Request</button>
    <div id="returned">

    </div>

    <script>
    document.querySelector("#ratelimit").addEventListener('click', function() {
        fetch("api/api.php", {
                withCredentials: true,
                headers: {
                    "X-Auth-Token": "ef72570ff371408f9668e414353b7b2e",
                    "Content-Type": "application/json"
                }
            })
            .then(res => res.json())
            .then(res => {
                console.log(res);
            })
    });
    </script>
</body>

</html>