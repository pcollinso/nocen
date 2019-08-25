<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>{{ $pageTitle }}</title>
    <style type="text/css">
        /* FONTS */
        
        @media screen {
            /* latin-ext */
            @font-face {
                font-family: 'Montserrat';
                font-style: normal;
                font-weight: 400;
                src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v12/JTUSjIg1_i6t8kCHKm459Wdhyzbi.woff2) format('woff2');
                unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
            }
            /* latin */
            @font-face {
                font-family: 'Montserrat';
                font-style: normal;
                font-weight: 400;
                src: local('Montserrat Regular'), local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v12/JTUSjIg1_i6t8kCHKm459Wlhyw.woff2) format('woff2');
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
            }
        }
        
        body {
            font-family: 'Montserrat', 'Courier New', Courier, monospace
        }
        
        .auto-style2 {
            text-align: center;
        }
        
        .auto-style3 {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 16pt;
            color: #363636;
        }
        
        .auto-style4 {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: 17pt;
            text-align: center;
        }
        
        .auto-style5 {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 11pt;
        }
        
        .auto-style6 {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: 11pt;
        }
        
        .tassy {
            height: 40px;
            background-color: #fff;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: 12px;
            border-right-style: solid;
            border-right-width: 2px;
            border-right-color: #FFFFFF;
            border-bottom-style: solid;
            border-bottom-width: 1px;
            border-bottom-color: #FFFFFF;
            font-weight: bold;
            padding-left: 20px;
            opacity: 0.7;
        }
        
        .tassx {
            height: 40px;
            background-color: #dcdcdc;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: 12px;
            border-right-style: solid;
            border-right-width: 2px;
            border-right-color: #FFFFFF;
            border-bottom-style: solid;
            border-bottom-width: 1px;
            border-bottom-color: #FFFFFF;
            text-align: left;
            padding-left: 20px;
            font-weight: bold;
            opacity: 0.7;
        }
        
        .opa {
            opacity: 0.6;
        }
        
        .auto-style7 {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: small;
        }
        
        .auto-style8 {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: small;
            text-align: center;
            color: #282727;
        }
        
        .auto-style9 {
            text-align: center;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: 10pt;
        }
        
        .auto-style10 {
            text-align: right;
        }
        
        .auto-style11 {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: x-small;
        }
        
        .auto-style12 {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: x-large;
            color: #FAF9F9;
        }
        
        .auto-style13 {
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
            font-size: x-small;
            text-align: right;
            color: #FFFFFF;
        }
        
        .auto-style14 {
            border: 1px solid #000000;
        }
        
        .col {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 15px;
            font-size: 0.9166em;
        }
        
        .col thead th {
            padding: 8px 10px;
            background: #34495E;
            border-bottom: 2px solid #FFFFFF;
            border-right: 2px solid #FFFFFF;
            text-align: center;
            color: white;
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .col thead th:last-child {
            border-right: none;
        }
        
        .col thead .desc {
            text-align: center;
        }
        
        .col thead .qty {
            text-align: center;
        }
        
        .col tbody td {
            padding: 8px;
            background: #E8F3DB;
            color: #000000;
            text-align: left;
            border-bottom: 2px solid #FFFFFF;
            border-right: 2px solid #FFFFFF;
            font-size: 10px;
        }
        
        .col tbody td:last-child {
            border-right: none;
        }

        .cert {
            font-size: 11px;
        }

        .subj {
            background: #34495E
            ;color: white;
        }

        .gra {
            background: #EBEBEB;f4f4f4
        }

        .grad {
            background: #f4f4f4;
        }


        @media print {
            .space {
                display: block;
                page-break-before: always;
            }
        }
    </style>
  </head>

  <body>
    <table id="content2" class="space" width="650" style="margin: 0 auto;">
      <tr>
        <td class="auto-style1">
          <table style="width: 100%">
            <tr style="background-color: #34495e;">
              <td>
                <table style="width: 100%">
                  <tr>
                    <td>
                      <img alt="logo" height="66" src="{{ asset('images/ertr.png') }}" width="200">
                    </td>
                    <td></td>
                    <td align="right" style="font-size: 12px; font-weight: bold;color:white;">
                        in affiliation with<br>
                      UNIVERSITY OF NIGERIA<br>
                      Nsukka
                    </td>
                    <td>
                      <img alt="logo" height="70" src="{{ asset('images/unn.png') }}" width="70">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" style="font-size: 15px; padding-top:20px; line-height: 20px; ">
                  <tr align="left">
                    <td width="100%">
                      <strong>OFFICE OF THE REGISTRAR</strong><br>
                      The Registrar<br>
                      Nwafor Orizu College of Education, Nsugbe<br>
                      <p style="text-decoration: underline;font-weight: bold; text-align: center;">ACCEPTANCE OF OFFER OF ADMISSION AND PLEDGE</p>
                      I, <strong>{{ $applicant->full_name }}</strong> hereby accept the offer of
                      provisional admission to prusue a 4 (Four) year course in the University. Leading
                      to <strong>Bachelor of Education</strong> in {{ $applicant->field->field_name }} under the
                      conditions stipulated in the letter of admission by the Admission and<br>
                      Matriculation Board Reference No.: _______<br>
                      Dated .: {{ date('D d M, Y') }}<br>
                      <strong>JAMB REG. NO.: {{ $applicant->j_regno }}</strong>
                      <p style="text-decoration: underline;font-weight: bold; text-align: center;">PLEDGE</p>
                      I <strong>{{ $applicant->full_name }},</strong> Registration Number.: {{ $applicant->j_regno }}
                      of the Department {{ $applicant->field->department->department_name }} In consideration of my being admitted into
                      the University of Nigeria hereby solemnly pledge to be of good behaviour and to
                      abide by the rules and regulations of the University of Nigeria and the college and
                      any other regulations of the Federal or any State Government specifically made to
                      ensure civilized and orderly community life in the college.<br>
                      I accept that failure and or refusal by me to abide by this undertaking shall enable
                      the college in its abosolute discretion to take any disciplinary action against me.
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="" valign="top">
                <table style="width: 100%">
                  <tr>                                
                    <tr>
                      <td class="auto-style7"><br>
                        <table width="100%" >
                          <tr>
                            <td style="font-size: 14px;">&nbsp;</td>
                            <td style="text-align: right">
                              Signature:___________________________<br><br>
                              Date:___________________________
                            </td>
                          </tr>
                        </table>
                      </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <script>
      window.print();
    </script>
  </body>
</html>