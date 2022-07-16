<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-weight: 500;
            font-family: Arial, sans-serif;
        }

        .btn {
            margin: 10px 0px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff !important;
            height: 46px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            background-image: linear-gradient(to right top, #021d68, #052579, #072d8b, #09369d, #093fb0) !important;
        }

        .btn:hover {
            text-decoration: none;
            opacity: .8;
        }
    </style>
</head>
<body style="margin:0;padding:0;">
<table role="presentation"
       style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
        <td align="center" style="padding:0;">
            <table role="presentation"
                   style="width:600px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                <tr style="border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;">
                    <td align="left" style="padding:10px 25px;background:#fff; display: flex; align-items: center;">
                        <span style="font-weight: bold; padding-top: 10px;"> UTT Booking Update - %%BOOKINGREF%% </span>
                    </td>
                </tr>
                <tr>
                    <td style="padding:36px 30px 42px 30px;">
                        <table role="presentation"
                               style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                            <tr>
                                <td style="padding:0 0 36px 0;color:#153643;">
                                    <p style="font-weight:bold;margin:0 0 5px 0;font-family:Arial,sans-serif;">
                                    <h5> Diolch am fod yn aelod o deulu UTT - Thank you for being part of the Under the Thatch family!</h5> </p>
                                    <p style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                        Please find information on an Under the Thatch booking below:
                                    </p>
                                    <table>
                                        <tr>
                                            <th>Booking ID:</th>
                                            <th>{{$booking['id']}}</th>
                                        </tr>
                                        <tr>
                                            <td>Guest Name:</td>
                                            <td>{{$booking['first_name'] . ' ' .$booking['last_name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Number of Guests: :</td>
                                            <td>{{$booking['guest']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Accommodation::</td>
                                            <td>hello</td>
                                        </tr>
                                        <tr>
                                            <td>Date Booked:</td>
                                            <td>{{$booking['from_date'] .' '. $booking['to_date']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Start Date</td>
                                            <td>{{$booking['from_date']}}</td>
                                        </tr>
                                        <tr>
                                            <td>End Date</td>
                                            <td>{{$booking['to_date']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>{{$booking['status']}}</td>
                                        </tr>
                                    </table>
                                    <p style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                        Please contact <a href="katie@underthethatch.co.uk" target="_blank"> katie@underthethatch.co.uk </a> if you need further assistance,
                                        or call 01239 727 029 with the Booking ID above.
                                    </p>
                                    <p style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                        You can access the owners' dashboard by clicking this link:
                                       <a href="https://www.underthethatch.co.uk/admin" target="_blank">https://www.underthethatch.co.uk/admin</a>

                                    </p>
                                    <p style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                        Cofion gorau, / best wishes, <br> Katie
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>