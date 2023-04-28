<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         @import url('http://fonts.cdnfonts.com/css/helvetica-neue-9');
        *{
            font-family: 'Helvetica Neue', sans-serif;
            padding: 0;
            margin: 0;
         }
        .title-email{
            background: linear-gradient(180deg, #52682F 0%, #99B869 138.75%);
            border-radius: 20px 0px;
            color: white;
            max-width: 200px;
            padding: 8px 10px;
            text-align: center;
            margin-left:auto;
        }
        .content{
            padding: 0px 100px;
            padding-top: 100px;
        }

        .button-orange{
            background: #DA771F;
            border-radius: 7px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            padding: 12px 15px;
        }

        .content p{
            color: #7D8590;
            font-size: 18px;
            margin-bottom: 50px;
        }
        .footer-left{
            background: #202320;
            border-radius: 0px 42px 0px 0px ;
            padding: 50px 70px;
        }
        .footer-left span{
            color: white;
        }
        footer{
            padding-top: 273px;
            background-image: url(/images/email/email-1.jpg);
            background-repeat: no-repeat;
            background-position: right;
            background-size: 40%;

        }
        
        .table-icon td{
            padding-left: 15px;
        }
        .table-icon td img{
            width: 35px;
        }

        .footer-right{
            padding: 0px 50px;
        }
        .image-footer{
                width: 100%;
            }

        @media(max-width:767px){

            .content{
                padding: 0px 50px;
                padding-top: 100px;
            }
            .footer-left{
                padding: 20px 10px;
                width: 60%;
            }

            .footer-left span{
                font-size: 12px;
            }

            .footer-right{
                padding: 0px 10px;
            }
            .image-footer{
                width: 100%;
            }
            
        }
    </style>
</head>
<body>
    <table border="0" role="presentation" cellpadding="0" cellspacing="0" width="100%"  style="padding: 0px 30px;">
        <tbody>
            <tr>
                <td width="50%">
                    <img src="{{asset('images/email/logo-ascelpio.png')}}" width="120px" alt="">
                </td>
                <td width="50%">
                     <div class="title-email">
                        <table width="100%" role="presentation" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="right">
                                    <img src="{{asset('images/email/verify.png')}}" width="27px" alt="">
                                </td>
                                <td>
                                    <span>Verifikasi Email</span>
                                </td>
                            </tr>
                        </table>
                     </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="content">
        <table border="0" role="presentation" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <h1>Hai Aprilia Indah Purnomo,</h1>
                    <p>Wowweee! Terimakasih telah mendaftar , sebelum mulai <br>
                       yuk verifikasi email kamu dengan klik link dibawah ini ya!
                    </p>
                    <a href="#" class="button-orange">Verifikasi Sekarang</a>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
    <footer>
        <table width="100%" border="0" class="footer-section" role="presentation" cellpadding="0" cellspacing="0">
            <tr>
                <td class="footer-left" width="60%">
                    <table border="0" role="presentation" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="vertical-align: top;">
                                <img src="{{asset('images/email/pin.png')}}" width="20px" alt="">
                            </td>
                            <td style="padding-left: 14px;">
                                <span>Jl. Pondok Wiyung Indah Timur III/Blok MX-18 RT 05 RW 07
                                Kota Surabaya, Jawa Timur 60115</span>
                            </td>
                        </tr>
                    </table>
                </td>
                <td align="right" class="footer-right">
                    <table border="0" role="presentation" cellpadding="0" cellspacing="0" class="table-icon">
                        <tr>
                            <td>
                                <img src="{{asset('images/email/globe.png')}}" alt="">
                            </td>
                            <td>
                                <img src="{{asset('images/email/instagram.png')}}" alt="">
                            </td>
                            <td>
                                <img src="{{asset('images/email/whatsapp.png')}}" alt="">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
    </footer>
</body>
</html>