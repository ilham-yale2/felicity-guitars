<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAM | Tickets</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        td, .text{
            font-size:18px;
        }
        #wrap{
            padding: 0;
        }

        .text-white{
            color: white;
        }

        .content{
            margin: auto;
            padding-bottom: 0px;
            background: url("{{ asset('images/Ticket.jpg') }}")  center / cover;
            background-position: center;
            background-size: cover;
        }

        .container{
            padding: 70px 50px;
            position: relative;
        }
        h2,h5{
            margin-block-start: 0em;
            margin-block-end: 0em;
            margin-inline-start: 0px;
        }

        .mb-1{
            margin-bottom: .5rem;
        }

        .ticket-number{
            color: #fffb00;
            margin-bottom: 80px;
            font-size: 29px;
        }

        .btn-yellow{
            /* background-color: #fffb00; */
            /* padding: 10px; */
            color: rgb(0, 0, 0);
            border-radius: 8px;
            display: block;
            margin-bottom: 48px;
            font-weight: normal;
            font-size: 15px;
        }

        .button{
            background:#fffb00;
            text-decoration: none;
            text-transform: none;
            padding: 10px;
            font-size: 15px;
            margin: 20px;
            color: black; 
            border-radius: 8px;

        }
        .d-flex{
            display: flex;
            width: 100%;
        }

        td{
            padding-left: 0px;
        }
        table{
            border-spacing: 0px;
            font-size: 13px!important;
        }

        .logo-tam{
            
            width: 80px;
        }

        .table tr td{
            padding-bottom: 8px;
            vertical-align: top;
        }
        table td:nth-child(1){
            width: 250px;
        }
        .pl-2{
            padding-left: 12px;
        }

        .footer{
            padding: 10px;
            text-align: center;
            background-color: white;
        }

        .footer{
            padding: 20px;
            background-color: #DF2522!important;
        }
        
        .text-white-all *{
            color: white!important;
        }

        .text-body p {
            width: 70%;
        }
        @media(max-width: 950px){
            .logo-tam{
                width: 100px;
            }

            table th:nth-child(1){
                width: auto;
            }
            table td:nth-child(3){
                padding-left: 9px;
            }

            td, .text{
                font-size: 14px
            }
        }

        @media(max-width: 835px){
            .container{
                background-size: cover;
            }

            #wrap{
                padding: 0;
            }

        }

        @media(max-width:680px){

            .text-body p {
                width: 100%;
            }
            
        }
        @media(max-width:580px){
            .logo-tam{
                width: 40px;
            }
            .container{
                padding: 20px;
            }

            .content{
                background-size: cover;
                background-position: center;
            }
        }
    </style>
    
</head>
<body>
  <div id="wrap">
    
    <div class="content">
        <div class="container">
            <table width="100%">
                <tr style="vertical-align: top;">
                    <td>
                        
                    </td>
                    <td style="text-align: right;">
                        <img src="{{ asset('images/tam-logo-2.png') }}" class="logo-tam" width="100px" alt="">
                    </td>
                </tr>
            </table>
            <table width="100%" class="table text-white" style="margin-top: 30px">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>Panduan E-Learning </td>
                    <td>:</td>
                    <td class="pl-2">
                        <a href="https://drive.google.com/file/d/1PkPgCs8SNs_0Gu06lGyB5LNJ8FCJTzPW/view?usp=drivesdk">click here!</a>
                        <h4 style="font-size:20px;"><b>REMINDER</b></h4> <br>
                        <p>
                            Terima kasih telah berpartisipasi dalam e-learning dan telah menyelesaikan Hall PDP! Permainan hampir selesai.. <br> <br> 
            
                            Silahkan akses kembali e-learning Anda untuk menyelesaikan Hall AB dengan kode tiket yang sudah diberikan.  <br> <br>
            
                            Hall AB adalah virtual room yang dapat diakses dengan memutar layar 360 derajat. Terdapat 3 booth menarik yang dapat Anda mainkan!
                        </p>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Kode Tiket</td>
                    <td>:</td>
                    <td class="text-white-all pl-2">
                        {{-- {{ $user->ticket->ticket_number }} --}} 1010021219021397
                    </td>
                    <td></td>
                </tr>
                
                
            </table>
           
            
           
        </div>
        {{-- <div class="footer">
            <a class="button" href="{{ route('user.home') }}">E-learning</a>
        </div> --}}
    </div>
  </div>
</body>
</html>