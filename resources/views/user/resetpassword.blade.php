<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
    <style>
        /* Add your custom CSS styles here for the reset password view */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .header {
            background-color: #4285F4;
            color: #fff;
            padding: 20px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .content {
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #4285F4;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reset Password</h2>
        </div>
        <div class="content">
            <form action="{{ route('user.updatepassword') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" required >
                    
                </div>
                
                <div>
                    <label for="password">New Password:</label>
                    <input type="password" name="password" required>
                    @error('password') 
                    <div style="color:red;">
                       {{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" required>
                    @error('password_confirmation')
                    <div style="color:red;">
                       {{$message}}
                    </div>
                    @enderror
                </div>
                <button type="submit">Reset Password</button>
            </form>
        </div>       
    </div>
</body>
</html>
