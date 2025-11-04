<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 | Access Denied</title>

    <style>
        body {
            background: #000;
            color: #ff3b3b;
            font-family: "Courier New", monospace;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            overflow: hidden;
        }

        h1 {
            font-size: 6rem;
            letter-spacing: 10px;
            animation: glow 2s infinite alternate;
        }

        h2 {
            font-size: 1.5rem;
            margin-top: -10px;
            opacity: 0.8;
        }

        .scanline {
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #ff3b3b, transparent);
            animation: scan 1.8s infinite;
            position: absolute;
            top: 0;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 10px red, 0 0 20px crimson;
            }

            to {
                text-shadow: 0 0 30px red, 0 0 60px crimson;
            }
        }

        @keyframes scan {
            0% {
                top: 0;
            }

            100% {
                top: 100%;
            }
        }

        a.btn {
            margin-top: 30px;
            padding: 10px 25px;
            border: 2px solid #ff3b3b;
            color: #ff3b3b;
            text-decoration: none;
            letter-spacing: 2px;
            transition: 0.3s;
        }

        a.btn:hover {
            background: #ff3b3b;
            color: #000;
        }
    </style>

</head>

<body>

    <div class="scanline"></div>

    <h1>403</h1>
    <h2>ACCESS DENIED!</h2>

    <p>You do not have permission to view this page.</p>

    <a href="{{ url('/dashboard') }}" class="btn">GO TO HOME</a>

</body>

</html>
