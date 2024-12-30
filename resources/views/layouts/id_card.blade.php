<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navtech - Employee Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRbb8k6Gkh9QjzQ0ebZhwlR+yZNuq8pLuZSkMyx7U" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #646464;
            flex-direction: column;
            width: 100%;
            /*height: 100%;*/
        }

        .header {
            width: 100%;
            height: 6%;
            background-color: #322C2B;
            color: white;
            /*padding: 10px 20px;*/
            display: flex;
            align-items: center;
            justify-content: space-around;
            /*gap: 10px;*/
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header .logo {
            height: 2.2rem;
        }

        .header .title {
            font-size: 18px;
            font-weight: bold;
        }

        .id-card {
            width: 300px;
            height: 450px;
            border-radius: 10px;
            box-shadow: 0 4px 20px 4px rgb(28 57 77 / 42%);
            background: #322C2B;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .id-card .logo {
            width: 80px;
            margin-bottom: 20px;
        }

        .id-card .photo {
            width: 100%;
            /*height: 100px;*/
            /*border-radius: 50%;*/
            /*object-fit: cover;*/
            border: 2px solid #4CAF50;
            margin-bottom: 15px;
        }

        .id-card .name {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .id-card .designation {
            font-size: 12px;
            color: #777;
            margin-bottom: 10px;
        }

        .id-card .details {
            font-size: 12px;
            color: #555;
            margin-top: 10px;
            line-height: 1.5;
        }

        .id-card .details span {
            font-weight: bold;
        }

        .id-card .footer {
            margin-top: auto;
            font-size: 10px;
            color: white;
            width: 100%;
            background: black;
        }

        .adjust{
            display: flex;
            align-items: center;
            height: 100vh;
            margin: 0;
            /*background-color: #f4f4f9;*/
        }
        .text-white {
            color: #fff !important;
        }

    </style>
</head>
<body class="blur">
<div class="header">
    <img src="/logo-white-02.svg"
         class="logo "
         alt="logo">
    <div class="title">Employee Verification Portal</div>
</div>
<div class="adjust text-white">
        <div class="id-card">
            <img src="{{ asset('/storage/navtech/id_photo/'.$details['id_photo'])}}" alt="Employee Photo" class="photo">
            <div class="name text-white">{{ $details['name'] }}&nbsp{{ $details['last_name'] }}</div>
            <div class="designation text-white">{{ $details['designation'] }}</div>
            <div class="details text-white">
                <p><span>Company ID:</span> {{ $details['emp_code'] }}</p>
                <p><span>Joining Date:</span> {{ $details['date_of_joining'] }}</p>
                <p><span>Team:</span> {{ $details['department'] }}</p>
                <p><span>Blood Group:</span> {{ $details['blood_group'] }}</p>
            </div>
        <div class="footer">© 2024 Nav Wireless Technologies Pvt. Ltd.</div>
     </div>
</div>
</body>
</html>
