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
                  <tr >
                    <td>
                      <table style="padding-bottom:20px; width: 100%;">
                        <tr>
                          <td> <img alt="logo" height="80" src="/storage/passports/{{ $applicant->passport }}" width="80" /></td>
                          <td align="right">
                            Student Address: {{ $applicant->resaddr }}
                            <p>Date: </p>
                          </td>
                        </tr>
                      </table>
                    </td>                           
                  </tr>
                  <tr align="left">
                    <td width="100%">
                      <strong>
                        The Registrar,<br>
                        Nwafor Orizu College of Education, Nsugbe<br>
                        Nsukka
                      </strong><br>                                  
                      <p style="text-decoration: underline;font-weight: bold; text-align: center;">LETTER OF UNDERTAKING</p>
                      I, Mr/Mrs/Miss: <strong>{{ $applicant->full_name }},</strong> whose passport photograph is attached herewith, humbly request the
                      University/College to admit and allow me register provisionally and at my own risk under the following terms.<br><br>
                      A  &nbsp;&nbsp;&nbsp;&nbsp;(i) That my entry qualifications, copies of which I have submitted/intend to submit are in accordance with the minimum and the
                      faculty/department entry requirement of the University.<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ii) That if at any time in future it is discovered that I do not possess the minimum entry requirement of the course as prescribed by
                      the senate of the University, the offer of admission will be withdrawn<br><br>
                      B &nbsp;&nbsp;&nbsp;&nbsp;My academic qualifications are as follows:<br>
                    </td>
                  </tr>
                  <tr>
                    <table width="200" class="cert" cellpadding="7">
                      <tbody style="">
                        <tr style="background: #34495E;color: white; margin:30px;">
                          <!-- <th scope="col">NCE </th> -->
                          <th scope="col">*GCE/WAEC/NECO </th>
                          <th scope="col">*DIP/ACE/TCII/GCE/WAEC/NECO(2) </th>
                        </tr>
                        <tr>
                          <!-- <td>YEAR OF ADMISSION.: _ _ _ _ _ _ <br>EXAM NO.: _ _ _ _ _ _ _  </td> -->
                          <td>
                            YEAR OF EXAM.: {{ $applicant->olevelResults[0]->examType->olevel_name }}, {{ $applicant->olevelResults[0]->year }}<br> 
                            EXAM NO.: {{ $applicant->olevelResults[0]->exam_reg }} 
                          </td>
                          @if(count($applicant->olevelResults) == 2)
                          <td>
                            YEAR OF EXAM.: {{ $applicant->olevelResults[1]->examType->olevel_name }}, {{ $applicant->olevelResults[1]->year }}<br> 
                            EXAM NO.: {{ $applicant->olevelResults[1]->exam_reg }} 
                          </td>
                          @endif
                        </tr>
                        <tr>
                          <!-- <td>
                            <table width="200" cellpadding="5">
                              <tbody>
                                <tr class="subj">
                                  <th scope="col" width="80">SUBJECTS </th>
                                  <th scope="col" width="20">GRADES </th>
                                </tr>
                                <tr class="grad">
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr class="gra">
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr class="grad">
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </tbody>
                            </table>
                          </td> -->
                          <td>
                            <table width="200" cellpadding="5">
                              <tbody>
                                <tr class="subj">
                                  <th scope="col" width="80">SUBJECTS </th>
                                  <th scope="col" width="20">GRADES </th>
                                </tr>
                                @for ($i = 1; $i <= 9; $i++)
                                <tr class="grad">
                                  <td>{{ $subjects[$applicant->olevelResults[0]->{"sub$i"}] }}</td>
                                  <td>{{ $grades[$applicant->olevelResults[0]->{"gd$i"}] }}</td>
                                </tr>
                                @endfor
                              </tbody>
                            </table>
                          </td>
                          @if(count($applicant->olevelResults) == 2)
                          <td>
                            <table width="200" cellpadding="5">
                              <tbody>
                                <tr class="subj">
                                  <th scope="col" width="80">SUBJECTS </th>
                                  <th scope="col" width="20">GRADES </th>
                                </tr>
                                @for ($i = 1; $i <= 9; $i++)
                                <tr class="grad">
                                  <td>{{ $subjects[$applicant->olevelResults[1]->{"sub$i"}] }}</td>
                                  <td>{{ $grades[$applicant->olevelResults[1]->{"gd$i"}] }}</td>
                                </tr>
                                @endfor
                              </tbody>
                            </table>
                          </td>
                          @endif
                        </tr>
                      </tbody>
                    </table>
                  </tr>
                  <tr>
                    <td height="" valign="top">
                      <table style="width: 100%">
                        <tr>
                          <td class="auto-style7"><br>
                            <table width="100%">
                              <tr align="left">
                                <td width="100%"> 
                                C &nbsp;&nbsp;&nbsp;&nbsp;Other particulars about me are follows:<br><br>
                                  COURSE TO WHICH ADMITTED: {{ $applicant->field->field_name }}<br>
                                  DEPARTMENT OF: {{ $applicant->field->department->department_name }}<br>
                                  FACULTY/SCHOOL: {{ $applicant->field->faculty->faculty_name }}<br>
                                  I certify on my honour that the above statement are true and therefore correct.<br><br>                                
                                </td>
                              </tr>
                              <tr>
                                <td style="font-size: 14px;">
                                  ____________________<br><br>
                                  Signature
                                </td>
                                <td style="text-align: right">
                                  ____________________<br><br>
                                  Date 
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
        </td>
      </tr>
    </table>
    <script>
      window.print();
    </script>
  </body>
</html>