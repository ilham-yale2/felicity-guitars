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
            background: linear-gradient(180deg, #664D40 0%, #9A6868 100%);
            border-radius: 0px 20px;
            color: white;
            max-width: 200px;
            padding: 8px 10px;
            text-align: center;
        }

        .title-email span {
            color: white!important;
        }

        .body-content{
            background-color: #F4F6E1;
            background-image: url('{{url("images/emailing")}}/header-3.png');
            background-position:0%  -20% ;
            background-repeat: no-repeat;
            background-size: 100% auto;
            padding-top: 10px;
        
        }

        .section-content{  
            background-image: url('{{url("images/emailing")}}/email-5.png');
            background-position:0%  100% ;
            background-size: 25%;
            background-repeat: no-repeat;
            padding-bottom: 100px;
            padding-top: 40px;
        }

        .content{
            width: 80%;
            margin: 0px auto;
            padding-top: 180px;
        }
        .content h1{
            text-align: center;
            text-decoration: underline;
            margin-bottom: 50px;
        }

        .button-orange{
            background: #DA771F;
            border-radius: 7px;
            font-weight: 700;
            color: white!important;
            text-decoration: none;
            padding: 16px 30px;
        }

        .content p{
            color: #7D8590;
            font-size: 18px;
            margin-top: 40px;
            text-align: center;
        }

        .content .code{
            margin-bottom: 40px;
            margin-top: 20px;
            color: #DA771F;
            text-align: center;
            text-decoration: underline;
        }

        .button{
            margin: 50px 0px;
            margin-bottom: 60px;
        }

        .footer span{
            color: white;
        }
        .footer{
            padding: 50px 0px;
        }
        
        .mx-auto{
            margin: 0px auto;
        }

        .table-icon td:nth-child(2){
            padding: 0px 20px;
        }
        .table-icon td img{
            width: 45px;
        }

        .footer-right{
            background: #202320;
            border-radius: 42px 0px 0px 0px;
            text-align: center;
        }

        .header{
            padding: 0px 30px;
        }

        .head-logo{
            width: 120px;
        }
        .text-gray{
            color: #7D8590;
        }
       
        .footer-content{
            background: #202320;
            border-radius: 42px 42px 0px 0px;
            background-size: 50% auto;
            background-position: 0% 100%;
            background-repeat: no-repeat;

        }

        .footer-content{
            margin-top: -50px;
        }
        

        .class-list {
            margin-bottom: 80px;
            margin-top: 50px;
        }

        .img-footer{
            width: 70%!important;
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
            .footer{
                padding: 20px;
            }

            .body-content{
                padding-top: 20px;
                background-size: 150%;
                background-position: 40% top;
            }

            .section-content{
                background-size: 30%;
                padding-bottom: 50px;
            }


            .footer-content{
                margin-top: -27px;
            }
            
        }

        @media(max-width:500px){
            .content{
                padding: 0px 20px;
                padding-top: 50px;
            }

            .section-content {
                padding-bottom: 50px
            }

            .button{
                margin-bottom: 30px;
            }

            .content p{
                margin-top: 20px;
            }

            .content .code{
                margin-bottom: 10px;
                margin-top: 10px;
            }

            .footer-right{
                padding: 0px ;
                padding-right: 15px;
            }
            .table-icon td{
                padding-left: 8px;
            }
            .table-icon td img{
                width: 28px;
            }

            .header{
                padding: 0px 10px;
            }
            .head-logo{
                width: 70px;
            }
            .content p{
                color: #7D8590;
                font-size: 14px;
            }
            .content h1{
                font-size: 20px;
                margin-bottom: 30px
            }

            .footer-left{
                width: 65%
            }

            .footer-left span{
                font-size: 10px
            }
            .title-email{
                border-radius: 0px 20px;
                color: white;
                max-width: 110px;
                font-size: 13px;
                padding: 8px;
                text-align: center;
            }

            .title-email img{
                width: 20px
            }

            .table-icon img{
                width: 20px
            }
            .table-icon td{
                padding-right: 0px;
            }
        }
    </style>
</head>
<body>
    <div class="body-content">
        <table border="0" role="presentation" cellpadding="0" cellspacing="0" width="100%" class="header">
            <tbody>
                <tr>
                    
                    <td width="50%">
                        <div class="title-email">
                            <table width="100%" role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td >
                                        <img src="{{url('images/emailing')}}/speaker.png" width="27px" alt="">
                                    </td>
                                    <td>
                                        <a href="">
                                            <span>Pengumuman</span>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td width="50%" align="right">
                        <img src="{{url('images/emailing')}}/logo-asclepio.png" class="head-logo" alt="">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="section-content">
            <div class="content">
                <h1>Hanya untuk Asclepian</h1>
                <p class="text-gray">
                    No more Monday Blues karena Senin kali ini super spesial sale 10.10
                </p>
                <p>
                    Super Sale Skills Lab dengan pendalaman topik esensial bagi Dokter Umum / Internship /
                    Koass. Review singkat & padat jelas bersama puluhan narasumber terfavorit
                </p>
                <p>
                    Gunakan kode voucher dan dapatkan 20% off ALL ITEM!
                </p>
                <h2 class="code">
                    1010ASCLEPIO
                </h2>
                <p>
                    Berlaku hingga 15 Oktober 2022, buruan
                </p>
                <table width="100%" class="button">
                    <tr>
                        <td width="100%" align="center">
                            <a href="#" class="button-orange" style="text-align: center;">Tukar Kode Voucher Disini </a>
                        </td>
                    </tr>
                </table>
                <table width="100%" border="0" class="footer-section" role="presentation" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="footer-left" width="100%" align="center">
                            <table border="0" role="presentation" cellpadding="0" cellspacing="0" class="table-icon">
                                <tr>
                                    <td>
                                        <a href="">
                                            <img src="{{url('images/emailing')}}/globe.png" alt="">
                                        </a>
                                    </td>
                                    <td style="padding: 0px 10px">
                                        <a href="">
                                            <img src="{{url('images/emailing')}}/instagram.png" alt="">
                                        </a>
                                    </td>
                                    <td>
    
                                        <a href="">
                                            <img src="{{url('images/emailing')}}/whatsapp.png" alt="">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="footer-content">
            <div class="footer">
                <table width="100%" border="0" class="footer-section" role="presentation" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="footer-right"  align="center">
                            <table border="0" width="100%" role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding-left: 14px;">
                                        <img src="{{url('images/emailing')}}/pin.png" width="20px" alt="">
                                        <span style="margin-left:20px; ">Jl. Pondok Wiyung Indah Timur III/Blok MX-18 RT 05 RW 07
                                        Kota Surabaya, Jawa Timur 60115</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                
            </div>
        </div>

    </div>
</body>
</html>