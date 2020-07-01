<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Client;
use App\Restaurant;
use App\Produit;
use App\Commande;
use App\Detailcommande;
use App\Type;
use App\Ville;
use App\Typeproduit;
use App\Signature;
use App\Recuperation;
use App\Favori;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Service_Controller extends Controller
{

    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function login($token,$email,$password)
    {
        return response()->json(Client::all()[0]);
    }
    
    
        public function askrecuperation(Request $req){  
        try {
           // dd($req->emailrec);
            $cl = DB::table('clients')
            ->select('clients.id')
            ->where('clients.email','Like',$req->emailrec)
            ->get();
            if(sizeof($cl)>0)
            {
             $cl1= explode(":",$cl);
             $id= explode("}",$cl1[1]);
        
            $rec = new Recuperation();
            $rec->client_id=$id[0];
            $rec->code=md5(microtime());
            $rec->clicked=0;
            $rec->save();
            //dd($cl->email);
$to = "".$req->emailrec;
$subject = 'Foodeals';
$message = 'Hi Jane, your password ...'; 
$from = 'info@foodeals.com';
 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Portfolio - Responsive Email Template</title>
		<style type="text/css">
			/* ----- Custom Font Import ----- */
			@import url(https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&subset=latin,latin-ext);

			/* ----- Text Styles ----- */
			table{
				font-family: \'Lato\', Arial, sans-serif;
				-webkit-font-smoothing: antialiased;
				-moz-font-smoothing: antialiased;
				font-smoothing: antialiased;
			}

			@media only screen and (max-width: 700px){
				/* ----- Base styles ----- */
				.full-width-container{
					padding: 0 !important;
				}

				.container{
					width: 100% !important;
				}

				/* ----- Header ----- */
				.header td{
					padding: 30px 15px 30px 15px !important;
				}

				/* ----- Projects list ----- */
				.projects-list{
					display: block !important;
				}

				.projects-list tr{
					display: block !important;
				}

				.projects-list td{
					display: block !important;
				}

				.projects-list tbody{
					display: block !important;
				}

				.projects-list img{
					margin: 0 auto 25px auto;
				}

				/* ----- Half block ----- */
				.half-block{
					display: block !important;
				}

				.half-block tr{
					display: block !important;
				}

				.half-block td{
					display: block !important;
				}

				.half-block__image{
					width: 100% !important;
					background-size: cover;
				}

				.half-block__content{
					width: 100% !important;
					box-sizing: border-box;
					padding: 25px 15px 25px 15px !important;
				}

				/* ----- Hero subheader ----- */
				.hero-subheader__title{
					padding: 80px 15px 15px 15px !important;
					font-size: 35px !important;
				}

				.hero-subheader__content{
					padding: 0 15px 90px 15px !important;
				}

				/* ----- Title block ----- */
				.title-block{
					padding: 0 15px 0 15px;
				}

				/* ----- Paragraph block ----- */
				.paragraph-block__content{
					padding: 25px 15px 18px 15px !important;
				}

				/* ----- Info bullets ----- */
				.info-bullets{
					display: block !important;
				}

				.info-bullets tr{
					display: block !important;
				}

				.info-bullets td{
					display: block !important;
				}

				.info-bullets tbody{
					display: block;
				}

				.info-bullets__icon{
					text-align: center;
					padding: 0 0 15px 0 !important;
				}

				.info-bullets__content{
					text-align: center;
				}

				.info-bullets__block{
					padding: 25px !important;
				}

				/* ----- CTA block ----- */
				.cta-block__title{
					padding: 35px 15px 0 15px !important;
				}

				.cta-block__content{
					padding: 20px 15px 27px 15px !important;
				}

				.cta-block__button{
					padding: 0 15px 0 15px !important;
				}
			}
		</style>

		<!--[if gte mso 9]><xml>
			<o:OfficeDocumentSettings>
				<o:AllowPNG/>
				<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
		</xml><![endif]-->
	</head>

	<body style="padding: 0; margin: 0;" bgcolor="#eeeeee">
		<span style="color:transparent !important; overflow:hidden !important; display:none !important; line-height:0px !important; height:0 !important; opacity:0 !important; visibility:hidden !important; width:0 !important; mso-hide:all;">This is your preheader text for this email (Read more about email preheaders here - https://goo.gl/e60hyK)</span>

		<!-- / Full width container -->
		<table class="full-width-container" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#eeeeee" style="width: 100%; height: 100%; padding: 30px 0 30px 0;">
			<tr>
				<td align="center" valign="top">
					<!-- / 700px container -->
					<table class="container" border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="#ffffff" style="width: 700px;">
						<tr>
							<td align="center" valign="top">
								<!-- / Header -->
								<table class="container header" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
									<tr>
										<td style="padding: 30px 0 30px 0; border-bottom: solid 1px #eeeeee;" align="left">
											<a href="#" style="font-size: 30px; text-decoration: none; color: #000000;">MP</a>
										</td>
									</tr>
								</table>
								<!-- /// Header -->

								<!-- / Hero subheader -->
								<table class="container hero-subheader" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
									<tr>
										<td class="hero-subheader__title" style="font-size: 43px; font-weight: bold; padding: 80px 0 15px 0;" align="left">Product Design Portfolio</td>
									</tr>

									<tr>
										<td class="hero-subheader__content" style="font-size: 16px; line-height: 27px; color: #969696; padding: 0 60px 90px 0;" align="left">Sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</td>
									</tr>
								</table>
								<!-- /// Hero subheader -->

								<!-- / Title -->
								<table class="container title-block" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td align="center" valign="top">
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
												<tr>
													<td style="border-bottom: solid 1px #eeeeee; padding: 35px 0 18px 0; font-size: 26px;" align="left">Recent Works</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Title -->

								<!-- / Projects list -->
								<table class="container projects-list" border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top: 25px;">
									<tr>
										<td>
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td align="left">
														<a href="#"><img src="img/img1.jpg" width="235" height="235" border="0" style="display: block;"></a>
													</td>

													<td align="left">
														<a href="#"><img src="img/img2.jpg" width="235" height="235" border="0" style="display: block;"></a>
													</td>

													<td align="left">
														<a href="#"><img src="img/img3.jpg" width="235" height="235" border="0" style="display: block;"></a>
													</td>
												</tr>

												<tr>
													<td align="left">
														<a href="#"><img src="img/img4.jpg" width="235" height="235" border="0" style="display: block;"></a>
													</td>

													<td align="left">
														<a href="#"><img src="img/img5.jpg" width="235" height="235" border="0" style="display: block;"></a>
													</td>

													<td align="left">
														<a href="#"><img src="img/img6.jpg" width="235" height="235" border="0" style="display: block;"></a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Projects list -->

								<!-- / Title -->
								<table class="container title-block" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td align="center" valign="top">
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
												<tr>
													<td style="border-bottom: solid 1px #eeeeee; padding: 35px 0 18px 0; font-size: 26px;" align="left">Simple text</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Title -->

								<!-- / Paragraph -->
								<table class="container paragraph-block" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td align="center" valign="top">
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
												<tr>
													<td class="paragraph-block__content" style="padding: 25px 0 18px 0; font-size: 16px; line-height: 27px; color: #969696;" align="left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
													tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
													quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
													consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
													cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
													proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Paragraph -->

								<!-- / Half block -->
								<table class="container half-block" border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top: 25px;">
									<tr>
										<td>
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td class="half-block__image" style="width: 353px; height: 325px;" width="353" height="325" background="img/img14.jpg">
													<!--[if gte mso 9]>
													<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width: 353px; height: 325px;" width="353" height="325">
													<v:fill type="frame" src="img/img14.jpg" color="#488bd3" />
													<v:textbox inset="0,0,0,0">
													<![endif]-->

													<!--[if gte mso 9]>
													</v:textbox>
													</v:rect>
													<![endif]-->
													</td>

													<td class="half-block__content" style="width: 50%; padding: 0 25px 0 25px; font-size: 16px; line-height: 27px; color: #969696; text-align: center;">
														Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Half block -->

								<!-- / Half block -->
								<table class="container half-block" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td>
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td class="half-block__content" style="width: 50%; padding: 0 25px 0 25px; font-size: 16px; line-height: 27px; color: #969696; text-align: center;">
														Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
													</td>

													<td class="half-block__image" style="width: 353px; height: 325px;" width="353" height="325" background="img/img15.jpg">
													<!--[if gte mso 9]>
													<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width: 353px; height: 325px;" width="353" height="325">
													<v:fill type="frame" src="img/img15.jpg" color="#488bd3" />
													<v:textbox inset="0,0,0,0">
													<![endif]-->

													<!--[if gte mso 9]>
													</v:textbox>
													</v:rect>
													<![endif]-->
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Half block -->

								<!-- / Divider -->
								<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top: 25px;" align="center">
									<tr>
										<td align="center">
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="border-bottom: solid 1px #eeeeee; width: 620px;">
												<tr>
													<td align="center">&nbsp;</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Divider -->

								<!-- / CTA Block -->
								<table class="container cta-block" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td align="center" valign="top">
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
												<tr>
													<td class="cta-block__title" style="padding: 35px 0 0 0; font-size: 26px; text-align: center;">About Us</td>
												</tr>

												<tr>
													<td class="cta-block__content" style="padding: 20px 0 27px 0; font-size: 16px; line-height: 27px; color: #969696; text-align: center;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
													tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
													quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
													consequat.</td>
												</tr>

												<tr>
													<td align="center">
														<table class="container" border="0" cellpadding="0" cellspacing="0">
															<tr>
																<td class="cta-block__button" width="230" align="center" style="width: 200px;">
																	<a href="http://slicejack.com/" style="border: 3px solid #eeeeee; color: #969696; text-decoration: none; padding: 15px 45px; text-transform: uppercase; display: block; text-align: center; font-size: 16px;">Visit Us</a>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// CTA Block -->

								<!-- / Divider -->
								<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top: 25px;" align="center">
									<tr>
										<td align="center">
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="border-bottom: solid 1px #eeeeee; width: 620px;">
												<tr>
													<td align="center">&nbsp;</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Divider -->

								<!-- / Info Bullets -->
								<table class="container info-bullets" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
									<tr>
										<td align="center">
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="width: 620px;">
												<tr>
													<td class="info-bullets__block" style="padding: 30px 30px 15px 30px;" align="center">
														<table class="container" border="0" cellpadding="0" cellspacing="0" align="center">
															<tr>
																<td class="info-bullets__icon" style="padding: 0 15px 0 0;">
																	<img src="img/img13.png">
																</td>

																<td class="info-bullets__content" style="color: #969696; font-size: 16px;">contact@example.com</td>
															</tr>
														</table>
													</td>

													<td class="info-bullets__block" style="padding: 30px 30px 15px 30px;" align="center">
														<table class="container" border="0" cellpadding="0" cellspacing="0" align="center">
															<tr>
																<td class="info-bullets__icon" style="padding: 0 15px 0 0;">
																	<img src="img/img11.png">
																</td>

																<td class="info-bullets__content" style="color: #969696; font-size: 16px;">(541) 754-3010</td>
															</tr>
														</table>
													</td>
												</tr>

												<tr>
													<td class="info-bullets__block" style="padding: 30px;" align="center">
														<table class="container" border="0" cellpadding="0" cellspacing="0" align="center">
															<tr>
																<td class="info-bullets__icon" style="padding: 0 15px 0 0;">
																	<img src="img/img12.png">
																</td>

																<td class="info-bullets__content" style="color: #969696; font-size: 16px;">New York, 222 West 23rd</td>
															</tr>
														</table>
													</td>

													<td class="info-bullets__block" style="padding: 30px;" align="center">
														<table class="container" border="0" cellpadding="0" cellspacing="0" align="center">
															<tr>
																<td class="info-bullets__icon" style="padding: 0 15px 0 0;">
																	<img src="img/img12.png">
																</td>

																<td class="info-bullets__content" style="color: #969696; font-size: 16px;">Paris, Champ de Mars 54</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Info Bullets -->

								<!-- / Social nav -->
								<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
									<tr>
										<td align="center">
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="border-top: 1px solid #eeeeee; width: 620px;">
												<tr>
													<td align="center" style="padding: 30px 0 30px 0;">
														<a href="#">
															<img src="img/img7.png" border="0">
														</a>
													</td>

													<td align="center" style="padding: 30px 0 30px 0;">
														<a href="#">
															<img src="img/img8.png" border="0">
														</a>
													</td>

													<td align="center" style="padding: 30px 0 30px 0;">
														<a href="#">
															<img src="img/img9.png" border="0">
														</a>
													</td>

													<td align="center" style="padding: 30px 0 30px 0;">
														<a href="#">
															<img src="img/img10.png" border="0">
														</a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Social nav -->

								<!-- / Footer -->
								<table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
									<tr>
										<td align="center">
											<table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="border-top: 1px solid #eeeeee; width: 620px;">
												<tr>
													<td style="text-align: center; padding: 50px 0 10px 0;">
														<a href="#" style="font-size: 28px; text-decoration: none; color: #d5d5d5;">MailPortfolio</a>
													</td>
												</tr>

												<tr>
													<td align="middle">
														<table width="60" height="2" border="0" cellpadding="0" cellspacing="0" style="width: 60px; height: 2px;">
															<tr>
																<td align="middle" width="60" height="2" style="background-color: #eeeeee; width: 60px; height: 2px; font-size: 1px;"><img src="img/img16.jpg"></td>
															</tr>
														</table>
													</td>
												</tr>

												<tr>
													<td style="color: #d5d5d5; text-align: center; font-size: 15px; padding: 10px 0 60px 0; line-height: 22px;">Copyright &copy; 2015 <a href="http://slicejack.com/" target="_blank" style="text-decoration: none; border-bottom: 1px solid #d5d5d5; color: #d5d5d5;">Slicejack</a>. <br />All rights reserved.</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<!-- /// Footer -->
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>';
 
// Sending email
if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}


            //$email=$req->emailrec;
           // Mail::to("ismail2010elalaoui@gmail.com")->send(new SendMailable($rec->code));
        
 //mail($to_email,$subject,$message,$headers);
         //   return  response()->json(["Error"=>"300"]);
            }
            else{
                return  response()->json(["Error"=>"304"]);
            }
        } catch(QueryException $ex){ 
            Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
            return  response()->json(["Error"=>"303"]);
          }
        
       }
       
    public function verifRest(Request $req)
    {
      //  $compte_trv=0; 
        $compte_ver=0;
       // dd(Hash::make($req->input('password')));
        if($req->has('email'))
        {
            if($req->input('email') == null)
            {
               return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
            }
           foreach( Restaurant::all() as $client)
           {
               
                  if($client->email == $req->input('email')){
                   $compte_ver=0;
                    if($client->verified_at!=null)
                    {
                       $client['codeEr']=300; 
                       return   response()->json($client);
                    }
                    if($compte_ver==0)
                    {
                    $client['codeEr']=301;      
                    return   response()->json($client);         
                    }
                    
                  }
                  
                
           }
            if($compte_trv==0)
           {
               return   response()->json(['codeEr'=>'303','msg'=>'login or password incorrecte']);
           } 
       }
       else
       {
           return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
       }
           
   
            return   response()->json($req->input());
   
       
    }
    //---------------verify client
    public function verifClient(Request $req)
    {
        $compte_trv=0; 
        $compte_ver=0;
       // dd(Hash::make($req->input('password')));
        if($req->has('email'))
        {
            if($req->input('email') == null)
            {
               return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
            }
           foreach( Client::all() as $client)
           {
               
                  if($client->email == $req->input('email')){
                   $compte_ver=0;
                    if($client->email_verified_at!=null)
                    {
                       $client['codeEr']=300; 
                       $compte_ver=1;
                       return   response()->json($client);
                    }
                    else if($compte_ver==0)
                    {
                    $client['codeEr']=301;      
                    return   response()->json($client);         
                    }
                    
                  }
                  
                
           }
            if($compte_trv==0)
           {
               return   response()->json(['codeEr'=>'303','msg'=>'login or password incorrecte']);
           } 
       }
       else
       {
           return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
       }
           
   
            return   response()->json($req->input());
   
       
    }


    public function Validation_Compte(Request $req)
    {
     try
     {
        $Rest = DB::table('restaurants')
        ->select('restaurants.*')
        ->where('restaurants.email',$req->email)
        ->get();
if(sizeof($Rest)>0)
{
        $rest = Restaurant::find($Rest[0]->id);
        $rest->password = Hash::make($req->password);
            if($req->has('token_frb'))
            {
           $rest->token_frb = $req->input('token_frb');
            }
        $rest->verified_at = Carbon::now();
        $rest->save();
        return   response()->json(['codeEr'=>'300','msg'=>'Bien activé']);
}
else
return   response()->json(['codeEr'=>'303','msg'=>'introuvable']);
     }
     catch(QueryException $ex){ 
        return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
      }
       
    }
    
        public function Validation_Client(Request $req)
    {
     try
     {
         
         
        $Rest = DB::table('clients')
        ->select('clients.*')
        ->where('clients.email',$req->email)
        ->get();
if(sizeof($Rest)>0)
{
        $rest = Client::find($Rest[0]->id);
        $rest->password = Hash::make($req->password);
        $rest->email_verified_at = Carbon::now();
        $rest->save();
        return   response()->json(['codeEr'=>'300','msg'=>'Bien activé']);
}
else
return   response()->json(['codeEr'=>'303','msg'=>'introuvable']);
     }
     catch(QueryException $ex){ 
        return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
      }
       
    }
    
    
    public function Inscription(Request $rq){
      try
          { 
            //  return($rq->input());
      $cli=new Client();
      $cli->name=$rq->name;
      $cli->tel=$rq->tel;
      $cli->sexe=$rq->sexe;
      $cli->email=$rq->email;
      $cli->password=Hash::make($rq->password);
      //$cli->email_verified_at = Carbon::now();
      $cli->save();
      $cli['codeEr']=300; 
      
      return Response()->json($cli);
  }
  
  catch(QueryException $ex){ 
  return Response()->json(["codeEr"=>"304","msg"=>"error"]);
  }  
  }

  public function ajouteFavori(Request $rq){
        try{ 
            $fav=new Favori();
            $fav->clients_id=$rq->clients_id;
            $fav->restaurants_id=$rq->restaurants_id;
            $fav->save();
            $fav['codeEr']=300; 
            return Response()->json($fav);
        }catch(QueryException $ex){ 
            return Response()->json(["erreur"=>"304","msg"=>"error"]);
        }  
    }
    
     public function Allcitymaroc(Request $rq){
        try{ 
         $ville = Ville::all()->where('pays_id','27');
            return Response()->json($ville);
        }catch(QueryException $ex){ 
            return Response()->json(["erreur"=>"304","msg"=>"error"]);
        }  
    }
    
         public function cityByword(Request $rq){
        try{ 
           // return Response()->json($rq->name);
         $ville = Ville::where('pays_id','27')->where('words','like','%'.$rq->name.'%')->get();
         
         if($ville!=null)
         {
             
             $v = Ville::find($ville[0]->id);
             $v["codeEr"]="300";
             return Response()->json($v);
         }
         else
         {
             return Response()->json(["codeEr"=>"304","msg"=>"error"]);
         }
            return Response()->json($ville);
        }catch(QueryException $ex){ 
            return Response()->json(["codeEr"=>"304","msg"=>"error"]);
        }  
    }
    
    

    public function loginRest(Request $req)
    {
     $compte_trv=0; 
     $compte_ver=0;
    // dd(Hash::make($req->input('password')));
     if($req->has('email') && $req->has('password'))
     {
         if($req->input('email') == null || $req->input('password') == null)
         {
            return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
         }
        foreach( Restaurant::all() as $client)
        {
            
               if($client->email == $req->input('email') &&  Hash::check($req->input('password'),$client->password)){
                $compte_ver=1;
                 if($client->verified_at!=null)
                 {
                   
                         if($req->has('token_frb'))
                         {
                        $rest = Restaurant::find($client->id);
                        $rest->token_frb = $req->input('token_frb');
                        $rest->save();
                         }
                
                    $client['codeEr']=300; 
                    $compte_trv==1;
                    return   response()->json($client);
                 }
                 else
                 {
                    $client['codeEr']=301;
                    return   response()->json($client);
                 }
                 
               }
               
             
        }
         if($compte_trv==0)
        {
            return   response()->json(['codeEr'=>'303','msg'=>'login or password incorrecte']);
        } 
    }
    else
    {
        return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
    }
        

         return   response()->json($req->input());

    }
    public function RS_Login(Request $req)
    {

    }
        public function ListRestaurantsAll(Request $req)
    {
          if($req->type==0)
      {
           $listRestaus = DB::table('restaurants')
      ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
      ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
      ->select('restaurants.*','localisations.latitude as latitude','localisations.longitude as longitude','types.name as nameType')
    
    
      
      ->get();
       return response()->json($listRestaus);    
      }
      else
      {
      $listRestaus = DB::table('restaurants')
      ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
      ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
      ->select('restaurants.*','localisations.latitude as latitude','localisations.longitude as longitude','types.name as nameType')
    
      ->where('types.id',$req->type)
      
      ->get();
       return response()->json($listRestaus);  
      }
    }
         public function ListRestaurantsAllbycity(Request $req)
    {
     // return response()->json($req->input());  
     
          if($req->type==0)
      {
             $listRestaus = DB::table('restaurants')
      ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
      ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('produits', 'restaurants.id', '=', 'produits.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
      ->join('villes', 'villes.id', '=', 'restaurants.villes_id')
      ->select('restaurants.id', 'restaurants.logo', 'restaurants.gerant', 'restaurants.tele', 'restaurants.localisations_id', 
        'restaurants.name', 'restaurants.email', 'restaurants.adresse',
        'restaurants.etat', 'restaurants.token_frb', 'restaurants.verified_at', 'restaurants.created_at', 'restaurants.updated_at','localisations.latitude as latitude','localisations.longitude as longitude','types.name as nameType',DB::raw('IFNULL(count(produits.id),0) as nmproduit'))
    

      ->where('villes.nom',$req->city)
      ->groupby('restaurants.id', 'restaurants.logo', 'restaurants.gerant', 'restaurants.tele', 'restaurants.localisations_id', 
        'restaurants.name', 'restaurants.email', 'restaurants.adresse',
        'restaurants.etat', 'restaurants.token_frb', 'restaurants.verified_at', 'restaurants.created_at', 'restaurants.updated_at','localisations.latitude','localisations.longitude','types.name')
      ->get();
       return response()->json($listRestaus);   
      }
      else
      {
           $listRestaus = DB::table('restaurants')
      ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
      ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('produits', 'restaurants.id', '=', 'produits.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
      ->join('villes', 'villes.id', '=', 'restaurants.villes_id')
      ->select('restaurants.id', 'restaurants.logo', 'restaurants.gerant', 'restaurants.tele', 'restaurants.localisations_id', 
        'restaurants.name', 'restaurants.email', 'restaurants.adresse',
        'restaurants.etat', 'restaurants.token_frb', 'restaurants.verified_at', 'restaurants.created_at', 'restaurants.updated_at','localisations.latitude as latitude','localisations.longitude as longitude','types.name as nameType',DB::raw('IFNULL(count(produits.id),0) as nmproduit'))
    
      ->where('types.id',$req->type)
      ->where('villes.nom',$req->city)
      ->groupby('restaurants.id', 'restaurants.logo', 'restaurants.gerant', 'restaurants.tele', 'restaurants.localisations_id', 
        'restaurants.name', 'restaurants.email', 'restaurants.adresse',
        'restaurants.etat', 'restaurants.token_frb', 'restaurants.verified_at', 'restaurants.created_at', 'restaurants.updated_at','localisations.latitude','localisations.longitude','types.name')
      ->get();
       return response()->json($listRestaus);    
      }
    }
    
    public function ListRestaurants(Request $req)
    {
      $listRestaus = DB::table('restaurants')
      ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
      ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
      ->select('restaurants.*','localisations.latitude as latitude','localisations.longitude as longitude','types.name as nameType')
      ->get();
       return response()->json($listRestaus);     
    }
        public function bestsales(Request $req)
    {
      $listRestaus = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
         ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
      ->select('restaurants.id','restaurants.name','restaurants.logo','restaurants.tele','restaurants.description','types.name as nameType','restaurants.description as descr',DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'))
      ->groupby('restaurants.id','restaurants.name','restaurants.logo','restaurants.tele','types.name','restaurants.description','restaurants.description')
      ->orderby('vendu','desc')
      ->limit(5)
      ->get();
       return response()->json($listRestaus);     
    }
            public function bestsalesbycity(Request $req)
    {
      $listRestaus = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
         ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
      ->join('villes', 'villes.id', '=', 'restaurants.villes_id')
    
      ->select('restaurants.id','restaurants.name','restaurants.logo','restaurants.tele','restaurants.description','types.name as nameType',DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'))
      ->where('villes.nom',$req->city)
      ->groupby('restaurants.id','restaurants.name','restaurants.logo','restaurants.tele','types.name','restaurants.description')
      ->orderby('vendu','desc')
      ->limit(5)
      ->get();
       return response()->json($listRestaus);     
    }
    public function ListRestaurantsWhereCity(Request $req)
    {
      $listRestaus = DB::table('restaurants')
      ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
      ->join('villes', 'villes.id', '=', 'restaurants.villes_id')
      ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
      ->select('restaurants.*','localisations.latitude as latitude','localisations.longitude as longitude','types.name as nameType')
      ->where('villes.nom',$req->city)
      ->get();
       return response()->json($listRestaus);     
    }
    public function ListProduit(Request $req)
    {

         $listProduits = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->join('typeproduits', 'typeproduits.id', '=', 'produits.typeproduits_id')
        ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->select('typeproduits.name as typeprod','restaurants.name as restName','restaurants.logo as logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at',
        'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.qte',DB::raw('hour(produits.started_at) as hd')
        ,DB::raw('hour(produits.finished_at) as hf'),DB::raw('Minute(produits.started_at) as md'),DB::raw('Minute(produits.finished_at) as mf')
        ,DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'),DB::raw('Date(produits.started_at)as dateDebut'),DB::raw('Date(produits.finished_at)as dateFin'))
        ->where('restaurants.id',$req->id)
        ->whereNull('produits.canceled_at')
        ->whereNull('produits.deleted_at')
        ->groupBy('typeproduits.name','restaurants.name','restaurants.logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at'
        ,'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.qte',DB::raw('hour(produits.started_at)',DB::raw('Date(produits.started_at)'),DB::raw('Date(produits.finished_at)'))
        ,DB::raw('hour(produits.finished_at)'),DB::raw('Minute(produits.started_at)'),DB::raw('Minute(produits.finished_at)'))
        ->orderBy('produits.created_at','desc')
        ->get();
       return response()->json($listProduits);   
    }
    
        public function DetComma(Request $req)
    {
         $listProduits = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->join('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->select('restaurants.name as restName','restaurants.logo as logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at',
        'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.qte','detailcommandes.qte as qtecmd',DB::raw('IFNULL(detailcommandes.op1,0) as op1'),DB::raw('IFNULL(detailcommandes.op2,0) as op2'),DB::raw('IFNULL(detailcommandes.op3,0) as op3'),DB::raw('IFNULL(detailcommandes.op4,0) as op4'),DB::raw('IFNULL(detailcommandes.op5,0) as op5'),DB::raw('IFNULL(detailcommandes.plus1,0) as plus1'),DB::raw('IFNULL(detailcommandes.plus2,0) as plus2'),DB::raw('IFNULL(detailcommandes.plus3,0) as plus3'),DB::raw('IFNULL(detailcommandes.plus4,0) as plus4'),DB::raw('IFNULL(detailcommandes.plus5,0) as plus5'),'detailcommandes.place','detailcommandes.emporter','detailcommandes.livraison','detailcommandes.plusl','detailcommandes.adressel','detailcommandes.tell',DB::raw('hour(produits.started_at) as hd')
        ,DB::raw('hour(produits.finished_at) as hf'),DB::raw('Minute(produits.started_at) as md'),DB::raw('Minute(produits.finished_at) as mf')
        ,DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'),DB::raw('Date(produits.started_at)as dateDebut'),DB::raw('Date(produits.finished_at)as dateFin'))
        ->where('produits.id',$req->id)
        ->where('detailcommandes.commandes_id',$req->idcom)
        ->whereNull('produits.canceled_at')
        ->whereNull('produits.deleted_at')
        ->groupBy('restaurants.name','restaurants.logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at'
        ,'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.qte','detailcommandes.qte',DB::raw('IFNULL(detailcommandes.op1,0)'),DB::raw('IFNULL(detailcommandes.op2,0)'),DB::raw('IFNULL(detailcommandes.op3,0)'),DB::raw('IFNULL(detailcommandes.op4,0) '),DB::raw('IFNULL(detailcommandes.op5,0)'),DB::raw('IFNULL(detailcommandes.plus1,0)'),DB::raw('IFNULL(detailcommandes.plus2,0)'),DB::raw('IFNULL(detailcommandes.plus3,0)'),DB::raw('IFNULL(detailcommandes.plus4,0)'),DB::raw('IFNULL(detailcommandes.plus5,0)'),'detailcommandes.place','detailcommandes.emporter','detailcommandes.livraison','detailcommandes.plusl','detailcommandes.adressel','detailcommandes.tell',DB::raw('hour(produits.started_at)',DB::raw('Date(produits.started_at)'),DB::raw('Date(produits.finished_at)'))
        ,DB::raw('hour(produits.finished_at)'),DB::raw('Minute(produits.started_at)'),DB::raw('Minute(produits.finished_at)'))
        ->orderBy('produits.created_at','desc')
        ->get();
        foreach($listProduits as $pro)
        {
            if($pro->op1==1)
            {
                $pro->op1= Produit::find($pro->id)->op1;
            }
               if($pro->op2==1)
            {
                $pro->op2= Produit::find($pro->id)->op2;
            }
               if($pro->op3==1)
            {
                $pro->op3= Produit::find($pro->id)->op3;
            }
               if($pro->op4==1)
            {
                $pro->op4= Produit::find($pro->id)->op4;
            }
               if($pro->op5==1)
            {
                $pro->op5= Produit::find($pro->id)->op5;
            }
        }
       return response()->json($listProduits);   
    }
    
    public function ListAllProduit(Request $req)
    {
     
         if($req->type==0)
         {
         
         $listProduits = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
        ->join('typeproduits', 'typeproduits.id', '=', 'produits.typeproduits_id')
        ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->select('typeproduits.name as typeprod','localisations.latitude as latitude','localisations.longitude as longitude','restaurants.name as type','restaurants.name as restName','restaurants.logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at',
        'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.livraison','produits.plusl','produits.qte',DB::raw('hour(produits.started_at) as hd'),DB::raw('Date(produits.started_at)as dateDebut'),DB::raw('Date(produits.finished_at)as dateFin')
        ,DB::raw('hour(produits.finished_at) as hf'),DB::raw('Minute(produits.started_at) as md'),DB::raw('Minute(produits.finished_at) as mf')
        ,DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'))
        ->whereNull('produits.canceled_at')
        ->whereNull('produits.deleted_at')
        ->groupBy('typeproduits.name','localisations.latitude','localisations.longitude','restaurants.name','restaurants.name','restaurants.logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at'
        ,'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.livraison','produits.plusl','produits.qte',DB::raw('hour(produits.started_at)')
        ,DB::raw('hour(produits.finished_at)'),DB::raw('Minute(produits.started_at)'),DB::raw('Minute(produits.finished_at)'))
        ->orderBy('produits.created_at','desc')
        ->get();
       return response()->json($listProduits);
         }
         else
         {
           
              $listProduits = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
        ->join('types', 'types.id', '=', 'typerestaurants.types_id')
        ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
        ->join('typeproduits', 'typeproduits.id', '=', 'produits.typeproduits_id')
   
        ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->select('typeproduits.name as typeprod','localisations.latitude as latitude','localisations.longitude as longitude','restaurants.name as type','restaurants.name as restName','restaurants.logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at',
        'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.livraison','produits.plusl','produits.qte',DB::raw('hour(produits.started_at) as hd'),DB::raw('Date(produits.started_at)as dateDebut'),DB::raw('Date(produits.finished_at)as dateFin')
        ,DB::raw('hour(produits.finished_at) as hf'),DB::raw('Minute(produits.started_at) as md'),DB::raw('Minute(produits.finished_at) as mf')
        ,DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'))
        ->whereNull('produits.canceled_at')
        ->whereNull('produits.deleted_at')
        ->where('types.id',$req->type)
        ->groupBy('typeproduits.name','localisations.latitude','localisations.longitude','restaurants.name','restaurants.name','restaurants.logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at'
        ,'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.livraison','produits.plusl','produits.qte',DB::raw('hour(produits.started_at)')
        ,DB::raw('hour(produits.finished_at)'),DB::raw('Minute(produits.started_at)'),DB::raw('Minute(produits.finished_at)'))
        ->orderBy('produits.created_at','desc')
        ->get();
       return response()->json($listProduits);
         }
    }
    public function ListAllProduitWhereCity(Request $req)
    {

         $listProduits = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
        ->join('typeproduits', 'typeproduits.id', '=', 'produits.typeproduits_id')
        ->join('villes', 'villes.id', '=', 'restaurants.villes_id')
        ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->select('typeproduits.name as typeprod','localisations.latitude as latitude','localisations.longitude as longitude','restaurants.name as type','restaurants.name as restName','restaurants.logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at',
        'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.qte',DB::raw('hour(produits.started_at) as hd'),DB::raw('Date(produits.started_at)as dateDebut'),DB::raw('Date(produits.finished_at)as dateFin')
        ,DB::raw('hour(produits.finished_at) as hf'),DB::raw('Minute(produits.started_at) as md'),DB::raw('Minute(produits.finished_at) as mf')
        ,DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'))
        ->whereNull('produits.canceled_at')
        ->whereNull('produits.deleted_at')
        ->groupBy('typeproduits.name','localisations.latitude','localisations.longitude','restaurants.name','restaurants.name','restaurants.logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at'
        ,'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.qte',DB::raw('hour(produits.started_at)')
        ,DB::raw('hour(produits.finished_at)'),DB::raw('Minute(produits.started_at)'),DB::raw('Minute(produits.finished_at)'))
        ->where('villes.nom',$req->city)
        ->orderBy('produits.created_at','desc')
        ->get();
       return response()->json($listProduits);   
    }
    public function ListFavoris(Request $req)
    {
        
    }

    public function ListProduitSolo(Request $req)
    {
         $listProduits = DB::table('produits')
         ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
         ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->select('produits.id as idProduit','produits.name as nameProduit','produits.prixini as prixiniProduit','produits.prix as prixProduit',DB::raw('Date(produits.started_at)as dateDebut'),DB::raw('Date(produits.finished_at)as dateFin'),
        'restaurants.id as idRest','restaurants.name  as nameRest','restaurants.logo',
        'produits.description as descriptionProduit','produits.qte as qteProduit',DB::raw('hour(produits.started_at) as hdProduit')
        ,DB::raw('hour(produits.finished_at) as hfProduit'),DB::raw('Minute(produits.started_at) as mdProduit'),DB::raw('Minute(produits.finished_at) as mfProduit'),DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'),'produits.op1','produits.op2','produits.op3','produits.op4','produits.op5',DB::raw('IFNULL(produits.plus1,0) as plus1'),DB::raw('IFNULL(produits.plus2,0) as plus2'),DB::raw('IFNULL(produits.plus3,0) as plus3'),DB::raw('IFNULL(produits.plus4,0) as plus4'),DB::raw('IFNULL(produits.plus5,0) as plus5'),'produits.place','produits.emporter','produits.libre','produits.livraison','produits.plusl')
        ->groupBy('restaurants.id','restaurants.name','restaurants.logo','produits.id','produits.name','produits.prixini','produits.prix','produits.started_at','produits.finished_at','produits.created_at'
        ,'produits.deleted_at','produits.canceled_at','produits.restaurants_id',
        'produits.description','produits.qte',DB::raw('hour(produits.started_at)')
        ,DB::raw('hour(produits.finished_at)'),DB::raw('Minute(produits.started_at)'),DB::raw('Minute(produits.finished_at)'),'produits.op1','produits.op2','produits.op3','produits.op4','produits.op5',DB::raw('IFNULL(produits.plus1,0)'),DB::raw('IFNULL(produits.plus2,0)'),DB::raw('IFNULL(produits.plus3,0)'),DB::raw('IFNULL(produits.plus4,0)'),DB::raw('IFNULL(produits.plus5,0)'),'produits.place','produits.emporter','produits.libre','produits.livraison','produits.plusl')
        ->where('produits.id',$req->id)
        ->orderBy('produits.created_at','desc')
        ->get();
       return response()->json($listProduits);   
    }

    public function ListProduitApreparer(Request $req)
    {
         $listProduits = DB::table('produits')
        ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
        ->join('restaurants', 'restaurants.id', '=', 'produits.produits_id')
        ->select( 'localisations.*', 'restaurants.*', 'produits.*')
        ->where('restaurants.id',$req->id)
        ->orderBy('produits.created_at','desc')
        ->get();
       return response()->json($listProduits);   
    }

    public function ListCommande(Request $req)
    {
         $listProduits = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->join('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
        ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
        ->join('clients', 'clients.id', '=', 'commandes.clients_id')
        ->select( 'commandes.id as idcom',DB::raw('hour(commandes.created_at) as hccom'),
         DB::raw('Minute(commandes.created_at) as mccom'),'commandes.created_at as comcreated_at','commandes.created_at as datecom',
        'produits.id as idpr','produits.name as namepr','produits.description as descpr','produits.qte as qtepr',DB::raw('hour(produits.started_at) as hdpr')
        ,DB::raw('hour(produits.finished_at) as hfpr'),DB::raw('Minute(produits.started_at) as mdpr'),'produits.prixini as prixini','produits.prix as prixpr'
        ,'detailcommandes.qte as qtedet','clients.name as namecl','clients.tel as telcl','detailcommandes.place','detailcommandes.emporter',DB::raw('IFNULL(detailcommandes.op1,0) as op1'),DB::raw('IFNULL(detailcommandes.op2,0) as op2'),DB::raw('IFNULL(detailcommandes.op3,0) as op3'),DB::raw('IFNULL(detailcommandes.op4,0) as op4'),DB::raw('IFNULL(detailcommandes.op5,0) as op5'),DB::raw('IFNULL(detailcommandes.plus1,0) as plus1'),DB::raw('IFNULL(detailcommandes.plus2,0) as plus2'),DB::raw('IFNULL(detailcommandes.plus3,0) as plus3'),DB::raw('IFNULL(detailcommandes.plus4,0) as plus4'),DB::raw('IFNULL(detailcommandes.plus5,0) as plus5')
        ,DB::raw('Minute(produits.finished_at) as mfpr'),DB::raw('Date(produits.started_at) as started_at'),'signatures.id as idsg','signatures.code as codesg','signatures.etat as etatsg',
        'signatures.created_at as created_atsg',DB::raw('Date(detailcommandes.date_collecte)as datec')
        ,DB::raw('hour(detailcommandes.date_collecte) as hc'),DB::raw('Minute(detailcommandes.date_collecte) as mc'),'detailcommandes.livraison','detailcommandes.plusl','detailcommandes.adressel','detailcommandes.tell')
        ->where('restaurants.id',$req->id)
        ->orderBy('commandes.created_at','desc')
        ->get();
       return response()->json($listProduits);   
    }

    public function GetRestaurants(Request $req)
    {
         $listProduits = DB::table('restaurants')
        ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
        ->select( 'restaurants.*', 'types.name as type')
        ->where('restaurants.id',$req->id)
        ->get();
       return response()->json($listProduits);   
    }


    public function ListRestaurantsparid(Request $req)
    {
      $listProduits = DB::table('produits')
      ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
      ->join('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
      ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
      ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
      ->join('clients', 'clients.id', '=', 'commandes.clients_id')
      ->select( 'commandes.id as idcom',DB::raw('hour(detailcommandes.date_collecte) as hccom'),
       DB::raw('Minute(detailcommandes.date_collecte) as mccom'),'commandes.created_at as comcreated_at',
      'produits.id as idpr','produits.name as namepr','produits.description as descpr','produits.qte as qtepr',DB::raw('hour(produits.started_at) as hdpr')
      ,DB::raw('hour(produits.finished_at) as hfpr'),DB::raw('Minute(produits.started_at) as mdpr'),'produits.prixini as prixini','produits.prix as prixpr'
      ,'detailcommandes.qte as qtedet',DB::raw('Date(detailcommandes.date_collecte)as datecom'),'clients.name as namecl','clients.tel as telcl'
      ,DB::raw('Minute(produits.finished_at) as mfpr'),DB::raw('Date(produits.started_at) as started_at'),'signatures.id as idsg','signatures.code as codesg','signatures.etat as etatsg',
      'signatures.created_at as created_atsg',DB::raw('IFNULL(detailcommandes.op1,0) as op1'),DB::raw('IFNULL(detailcommandes.op2,0) as op2'),DB::raw('IFNULL(detailcommandes.op3,0) as op3'),DB::raw('IFNULL(detailcommandes.op4,0) as op4'),DB::raw('IFNULL(detailcommandes.op5,0) as op5'),DB::raw('IFNULL(detailcommandes.plus1,0) as plus1'),DB::raw('IFNULL(detailcommandes.plus2,0) as plus2'),DB::raw('IFNULL(detailcommandes.plus3,0) as plus3'),DB::raw('IFNULL(detailcommandes.plus4,0) as plus4'),DB::raw('IFNULL(detailcommandes.plus5,0) as plus5'),'detailcommandes.place','detailcommandes.emporter','detailcommandes.livraison','detailcommandes.plusl','detailcommandes.adressel','detailcommandes.tell')
      ->where('commandes.id',$req->id)
      ->where('restaurants.id',$req->idrst)
      ->get();
     return response()->json($listProduits);    
    }

    public function GetProduit(Request $req)
    {
      $listProduits = DB::table('produits')
      ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
      ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
      ->select( 'produits.typeproduits_id',
      'produits.id as idpr','produits.name','produits.description','produits.qte',DB::raw('hour(produits.started_at) as hdpr')
      ,DB::raw('hour(produits.finished_at) as hfpr'),DB::raw('Minute(produits.started_at) as mdpr'),'produits.prixini','produits.prix'
      ,'detailcommandes.qte as qtedet',DB::raw('Date(detailcommandes.date_collecte)as datecom')
      ,DB::raw('Minute(produits.finished_at) as mfpr'),DB::raw('Date(produits.started_at) as ddpro'),DB::raw('Date(produits.finished_at) as dfpro')
      ,DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'),'produits.op1','produits.op2','produits.op3','produits.op4','produits.op5',DB::raw('IFNULL(produits.plus1,0) as plus1'),DB::raw('IFNULL(produits.plus2,0) as plus2'),DB::raw('IFNULL(produits.plus3,0) as plus3'),DB::raw('IFNULL(produits.plus4,0) as plus4'),DB::raw('IFNULL(produits.plus5,0) as plus5'),'produits.place','produits.emporter','produits.libre','produits.livraison','produits.plusl')
      ->where('produits.id',$req->id)
      ->groupBy( 'produits.typeproduits_id','produits.id','produits.name','produits.description','produits.qte',DB::raw('hour(produits.started_at)')
      ,DB::raw('hour(produits.finished_at)'),DB::raw('Minute(produits.started_at)'),'produits.prixini','produits.prix'
      ,'detailcommandes.qte',DB::raw('Date(detailcommandes.date_collecte)')
      ,DB::raw('Minute(produits.finished_at)'),DB::raw('Date(produits.started_at)'),DB::raw('Date(produits.finished_at)'),'produits.op1','produits.op2','produits.op3','produits.op4','produits.op5',DB::raw('IFNULL(produits.plus1,0)'),DB::raw('IFNULL(produits.plus2,0)'),DB::raw('IFNULL(produits.plus3,0)'),DB::raw('IFNULL(produits.plus4,0)'),DB::raw('IFNULL(produits.plus5,0)'),'produits.place','produits.emporter','produits.libre','produits.livraison','produits.plusl')
      ->get();
       return response()->json($listProduits);   
    }

    public function MesCommandes(Request $req)
    {
        $listComm = DB::table('detailcommandes')
        ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
        ->join('clients', 'clients.id', '=', 'commandes.clients_id')
        ->join('produits', 'detailcommandes.produits_id', '=', 'produits.id')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
        ->select('produits.id','produits.name as pro_name','produits.prix','commandes.created_at','detailcommandes.commandes_id as idcom','detailcommandes.qte','detailcommandes.date_collecte','restaurants.name','signatures.etat','signatures.code')
        ->where('clients.id',$req->id)
     
        ->orderBy('commandes.created_at','desc')
        ->get();
       return response()->json($listComm);   
    }

    public function MesProduitCom(Request $req)
    {
        $listComm = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->join('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
        ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
        ->join('clients', 'clients.id', '=', 'commandes.clients_id')
        ->select('restaurants.logo as logo','restaurants.name as restname',DB::raw('hour(detailcommandes.date_collecte) as hccom'),
         DB::raw('Minute(detailcommandes.date_collecte) as mccom'),'commandes.created_at as comcreated_at',
        'produits.id as idpr','produits.name as namepr','produits.description as descpr','produits.qte as qtepr',DB::raw('hour(produits.started_at) as hdpr')
        ,DB::raw('hour(produits.finished_at) as hfpr'),DB::raw('Minute(produits.started_at) as mdpr'),'produits.prixini as prixini','produits.prix as prixpr'
        ,'detailcommandes.qte as qtedet',DB::raw('Date(detailcommandes.date_collecte)as datecom'),'clients.name as namecl','clients.tel as telcl'
        ,DB::raw('Minute(produits.finished_at) as mfpr'),DB::raw('Date(produits.started_at) as started_at'),'signatures.id as idsg',
        'signatures.code as codesg','signatures.etat as etatsg',
        'signatures.created_at as created_atsg')
        ->where('clients.id',$req->clid)
        ->where('commandes.id',$req->comid)
        ->orderBy('produits.created_at','desc')
        ->get();
       return response()->json($listComm);   
    }

    public function newCommande(Request $req)
    {
      $inf = json_decode($req->input('array'));
 
       return response()->json($inf);   
    }

    public function InsererClient(Request $req)
    {
         $listProduits = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->select( 'restaurants.*', 'produits.*')
        ->where('restaurants.id',$req->id)
        ->get();
       return response()->json($listProduits);   
    }

    public function storeProduit(Request $request)
    {    
  // return Response()->json($request->input());
        //dd($request);
        $dd=$request->dd;
        $hd=$request->hd;

        $df=$request->df;
        $hf=$request->hf;
       DB::beginTransaction();
       try{ 
    

        $prod=new Produit();
        
        $prod->name=$request->name;
        $array = array($dd,$hd);
        $started= implode(" ", $array);

        $array1 = array($df,$hf);
        $finished= implode(" ", $array1);
           
      //dd($started);
        $prod->qte=$request->qte;
        $prod->description=$request->description;
        $prod->prix=$request->prix;
        
        $prod->op1=$request->op1=='-1'?null:$request->op1;
        $prod->op2=$request->op2=='-1'?null:$request->op2;
        $prod->op3=$request->op3=='-1'?null:$request->op3;
        $prod->op4=$request->op4=='-1'?null:$request->op4;
        $prod->op5=$request->op5=='-1'?null:$request->op5;
        
        $prod->plus1=$request->plus1=='-1'?null:$request->plus1;
        $prod->plus2=$request->plus2=='-1'?null:$request->plus2;
        $prod->plus3=$request->plus3=='-1'?null:$request->plus3;
        $prod->plus4=$request->plus4=='-1'?null:$request->plus4;
        $prod->plus5=$request->plus5=='-1'?null:$request->plus5;
        
        $prod->place=$request->place;
        $prod->emporter=$request->emporter;
        $prod->libre=$request->libre;
        $prod->livraison=$request->livraison;
        
        $prod->plusl=$request->plusl;
        $prod->prixini=$request->prixini;
        $prod->typeproduits_id=$request->type1;
        $prod->started_at=$started;
        $prod->finished_at=$finished;

    /* if($request->hasFile('photo'))
        {
            $prod->photo=$request->photo->store('images','public');
        }*/
        $prod->restaurants_id=$request->id;

   if($request->prix<$request->prixini)
   {
    $prod->save();
    
    DB::commit();        
        //dd($lct->id);
    return Response()->json(["codeEr"=>"300","msg"=>"produit bien ajouté"]);   
   }
   else
   return Response()->json(["codeEr"=>"303","msg"=>"le prix de vente est supérieur au prix initial"]);      
    }catch(QueryException  $ex)
        {
           
            return Response()->json(["codeEr"=>"303","msg"=>"Erreur SQL"]);
            DB::rollBack();
        
    }

    }
    
    public function updateProduit(Request $request)
    {
      //  dd($request->input());
      //return Response()->json($request->input());
        $dd=$request->dd;
        $hd=$request->hd;

        $df=$request->df;
        $hf=$request->hf;

   
            $proudInDCom=DB::table('detailcommandes')
            ->select('detailcommandes.produits_id')
            ->where('detailcommandes.produits_id',$request->idpr)
            ->get();

            if(sizeof($proudInDCom)!=0)
            {
                return response()->json(['codeEr'=>'302','msg'=>'ce produit n\'est pas modifier']);
            }
        else { 
           // dd($request->prix);
            if(floatval($request->prix) > floatval($request->prixini)){
                return response()->json(['codeEr'=>'301','msg'=>'le prix ou les date ou les heures incorrecte']);
            }
            else{
            $prod = Produit::find($request->idpr);
            //dd($prod);
            $array = array($dd,$hd);
            $started= implode(" ", $array);
            $array1 = array($df,$hf);
            $finished= implode(" ", $array1);
               
            $prod->typeproduits_id=$request->type1;       
            $prod->name=$request->name;
            $prod->qte=$request->qte;
            $prod->description=$request->description;
            $prod->prix=$request->prix;
            
        $prod->op1=$request->op1=='-1'?null:$request->op1;
        $prod->op2=$request->op2=='-1'?null:$request->op2;
        $prod->op3=$request->op3=='-1'?null:$request->op3;
        $prod->op4=$request->op4=='-1'?null:$request->op4;
        $prod->op5=$request->op5=='-1'?null:$request->op5;
        
        $prod->plus1=$request->plus1=='-1'?null:$request->plus1;
        $prod->plus2=$request->plus2=='-1'?null:$request->plus2;
        $prod->plus3=$request->plus3=='-1'?null:$request->plus3;
        $prod->plus4=$request->plus4=='-1'?null:$request->plus4;
        $prod->plus5=$request->plus5=='-1'?null:$request->plus5;
        
        $prod->place=$request->place;
        $prod->emporter=$request->emporter;
        $prod->libre=$request->libre;
                    $prod->livraison=$request->livraison;
        
        $prod->plusl=$request->plusl;
            $prod->prixini=$request->prixini;
            $prod->started_at=$started;
            $prod->finished_at=$finished;
            $prod->restaurants_id=$request->id;
            $prod->save();
             return response()->json(['codeEr'=>'300','msg'=>'produit modifier']);
        }
    }
 
}

public function updateClient(Request $req){
    //dd($req->input());
     $cli=Client::find($req->id);
     $cli->name=$req->name;
     $cli->tel=$req->tel;
     $cli->sexe=$req->sexe;
     $cli->email=$req->email;
     $cli->save();
     //$client = array($cli);
     return response()->json(['codeEr'=>'300',$req->input()]);
}
public function updatePassClient(Request $req){
    //dd($req->input());
     $cli=Client::find($req->id);
     $cli->password=Hash::make($req->password);
     $cli->save();
     //$client = array($cli);
     return response()->json(['codeEr'=>'300',$req->input()]);
}


    public function bloquerProduit(Request $request){
      try {
        //  dd($request->input());
      $proudInDCom=DB::table('detailcommandes')
      ->join('produits', 'produits.id', '=','detailcommandes.produits_id')
      ->select('detailcommandes.produits_id')
      ->where('detailcommandes.produits_id',$request->idpr)
      ->where('produits.restaurants_id',$request->id)
      ->get();
//dd($proudInDCom);
      
       if(sizeof($proudInDCom)==0){
          $Pro = Produit::find($request->idpr);
          $Pro->deleted_at= Carbon::now();
          $Pro->save();
          return Response()->json(["codeEr"=>"300","msg"=>"Bien Supprimé"]);

       }
       else if(sizeof($proudInDCom)!=0){
          $Pro = Produit::find($request->idpr);
          $Pro->canceled_at= Carbon::now();
          $Pro->save();
          return Response()->json(["codeEr"=>"301","msg"=>"Bien annulé"]);

       }
       
              
          else 
          return Response()->json(["codeEr"=>"304","msg"=>"erreur: déjà commandé"]); 
      
  } catch (QueryException  $ex) {
       return Response()->json(["codeEr"=>"304","msg"=>"error"]);        
  } 
      
  }
    
    
    public function LoginClient(Request $req)
    {
        $compte_trv=0; 
        $compte_ver=0;
       // dd(Hash::make($req->input('password')));
        if($req->has('email') && $req->has('password'))
        {
            if($req->input('email') == null && $req->input('password') == null)
            {
               return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
            }
           foreach( Client::all() as $client)
           {
               
                  if($client->email == $req->input('email') && Hash::check($req->input('password'),$client->password)){
                   $compte_trv==1;
                   $compte_ver=0;
                    if($client->email_verified_at!=null)
                    {
                       $client['codeEr']=300; 
                       return   response()->json($client);
                    }
                    if($compte_ver==0)
                    {
                    $client['codeEr']=301;      
                    return   response()->json($client);         
                    }
                    
                  }
                  
                
           }
            if($compte_trv==0)
           {
               return   response()->json(['codeEr'=>'303','msg'=>'login or password incorrecte']);
           } 
       }
       else
       {
           return   response()->json(['codeEr'=>'304','msg'=>'Assurez vous que vous avez bien remplis tous les champs !']);
       }
           
   
            return   response()->json($req->input());
   
       
    }
    
public function historique(Request $req)
{
    $listProduit=DB::table('produits')
        ->join('restaurants', 'produits.restaurants_id', '=','restaurants.id')
        ->LEFTJOIN('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->select('produits.id as idpr', 'produits.name as namepr','produits.started_at',
        'produits.finished_at','produits.qte as qtepr','produits.prix as prixpr',
        'produits.prixini as prixini',
        'produits.description as descpr',
        'produits.canceled_at','produits.created_at',
        (DB::raw('IFNULL(SUM(detailcommandes.qte),0) as vendu')))
        ->groupBy('produits.id',
        'produits.name',
        'produits.started_at',
        'produits.finished_at',
        'produits.qte',
        'produits.prix',
        'produits.prixini',
        'produits.description',
        'produits.canceled_at',
        'produits.created_at'
        )
        ->where('restaurants.id',$req->id)
        ->orderBy('produits.created_at','desc')
        ->get();
       // dd($listProduit);
       
       return response()->json( $listProduit);
}


function send_notification($msgbody,$title,$target)
{
	//echo 'Hello';
//define( 'API_ACCESS_KEY', 'YOUR API KEY HERE');
 //   $registrationIds = ;
#prep the bundle
     $msg = array
          (
		'body' 	=> $msgbody,
		'title'	=> $title
          );
	$fields = array
			(
				'to'		=> $target,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=AAAAqgMVsIU:APA91bEzHc53Umnq41YV5CAkCVWfkiKDPJw81MmMrBbVHt388bdtYCAan-TmY5OD_TGi24DJYxl8hKHJUvnv-Ffn8kin8z7jVa1YSdapDXn2bB2Bhx7FkycI85cwKYCqOYpoS10JzyDq',
				'Content-Type: application/json'
			);
#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		//echo $result;
		curl_close( $ch );
}
    
public function AjouterPanier(Request $request){
    try {
        
        //return response()->json(json_decode($request->input('user_id'))); 
        DB:: beginTransaction();
    $req=json_decode($request->input('array'));
      
     
        
        $sortedData = array();
        $i=0;
       
        foreach ($req as $element) {
           
            $timestamp = strtotime($element->dateCollete."".$element->hCollete);
           
            $date = date("Y-m-d H:i", $timestamp); 
            //return response()->json(['message'=> sizeof($sortedData)]);
            if ( ! isSet($sortedData[$date]) ) { 
                $sortedData[$i] = $element;
            } else { 
                $sortedData[$i] = $element;
            }
            $i++;
        }
        //return response()->json(['message'=> sizeof($sortedData)]);
        
    
    $tab=array(array($sortedData[0]));
      
       $k=0;
        for($i=1;$i<sizeof($sortedData);$i++){
            
             $hc1=strtotime($sortedData[$i-1]->hCollete);
            // 
             $dc1=strtotime($sortedData[$i-1]->dateCollete);
             $hc2=strtotime($sortedData[$i]->hCollete);
             $dc2=strtotime($sortedData[$i]->dateCollete);
             $total1=$dc1+$hc1;
             $total2=$dc2+$hc2;
             if($total1==$total2){
                array_push($tab[$k],$req[$i]);
             }
             else {
                $k++;
                array_push($tab,array($req[$i]));  
              }}
              
             // dd($tab);
            // return response()->json(['message'=> sizeof($sortedData)]);
              $cmd = new Commande();
              //$cmd->clients_id=$tab[0][0]->idClient; 
              $cmd->clients_id=$request->input('user_id');
              $cmd->save();

              for($i=0;$i<sizeof($tab);$i++){
                
              
                $rst=0;
                $signature=new Signature();
                for($k=0;$k<sizeof($tab[$i]);$k++){
                    
                    if($k==0)
                    {
                        
                        $signature->etat=0;
                        $signature->code=md5(microtime());
                        $signature->save();
                        $rst = $tab[$i][$k]->idRestau;
                    }
                    else if($rst!=$tab[$i][$k]->idRestau)
                    {
                        $signature=new Signature();
                        $signature->etat=0;
                        $signature->code=md5(microtime());
                        $signature->save();
                        $rst = $tab[$i][$k]->idRestau;
                    }
               
               $date= $tab[$i][$k]->dateCollete;
               $heure= $tab[$i][$k]->hCollete;
               $date_collecte= $date." ".$heure.":00";
               
              
                     $detail_cmd=new Detailcommande();
                     
                     $detail_cmd->commandes_id=$cmd->id;
                     $detail_cmd->produits_id=$tab[$i][$k]->idProduct;
                     $detail_cmd->qte=$tab[$i][$k]->qtePro;
                     $detail_cmd->date_collecte=$date_collecte;
                     $detail_cmd->signatures_id=$signature->id;
                     $detail_cmd->op1=$tab[$i][$k]->op1=='-1'?null:$tab[$i][$k]->op1;
                     $detail_cmd->op2=$tab[$i][$k]->op2=='-1'?null:$tab[$i][$k]->op2;
                     $detail_cmd->op3=$tab[$i][$k]->op3=='-1'?null:$tab[$i][$k]->op3;
                     $detail_cmd->op4=$tab[$i][$k]->op4=='-1'?null:$tab[$i][$k]->op4;
                     $detail_cmd->op5=$tab[$i][$k]->op5=='-1'?null:$tab[$i][$k]->op5;
                     $detail_cmd->plus1=$tab[$i][$k]->plus1=='-1'?null:$tab[$i][$k]->plus1;
                     $detail_cmd->plus2=$tab[$i][$k]->plus2=='-1'?null:$tab[$i][$k]->plus2;
                     $detail_cmd->plus3=$tab[$i][$k]->plus3=='-1'?null:$tab[$i][$k]->plus3;
                     $detail_cmd->plus4=$tab[$i][$k]->plus4=='-1'?null:$tab[$i][$k]->plus4;
                     $detail_cmd->plus5=$tab[$i][$k]->plus5=='-1'?null:$tab[$i][$k]->plus5;
                     $detail_cmd->place=$tab[$i][$k]->place;
                     $detail_cmd->emporter=$tab[$i][$k]->emporter;
                     $detail_cmd->livraison=$tab[$i][$k]->livraison;
                     $detail_cmd->plusl=$tab[$i][$k]->plusl;
                     $detail_cmd->adressel=$tab[$i][$k]->adressel;
                     $detail_cmd->tell=$tab[$i][$k]->tell;
                     $rst = $detail_cmd->save();
                     
                     
                     if(!$rst)
                     {
                        return response()->json(["erreur"=>"333","message"=>"Qte insuffisante"]); 
                     }
                     //return response()->json(['message'=> sizeof($sortedData)]);

                     $prorest=DB::table('produits')
                     ->join('restaurants', 'produits.restaurants_id', '=','restaurants.id')
                     ->select('produits.id as idpr', 'produits.name as namepr','restaurants.token_frb')
                     ->where('produits.id',$tab[$i][$k]->idProduct)
                     ->get();
                    // echo response()->json(['message'=> sizeof($prorest)]);
                    // $this->send_notificatio();
                     if(sizeof($prorest))
                     {
                         $bd="Détails commande : ".$tab[$i][$k]->qtePro." ".$prorest[0]->namepr.", Date de collecte le ".$date_collecte;
                         $tlt="Commande à traiter";
                        $this->send_notification($bd,$tlt,$prorest[0]->token_frb);
                     }
    
                  }
 
              }
              
              DB::commit();
              return response()->json(["erreur"=>"300","message"=>"Bien ajoutee"]); 
              //return response()->json($request);
      } catch (\Exception  $ex) {
              DB::rollback();  
                  return Response()->json(["erreur"=>"304","msg"=>$ex->getMessage()]);  
                    } 
    }

  public function send_notificatio()
  {

    $prorest=DB::table('produits')
    ->join('restaurants', 'produits.restaurants_id', '=','restaurants.id')
    ->select('produits.id as idpr', 'produits.name as namepr','restaurants.token_frb')
    ->where('produits.id',1)
    ->get();
    //return response()->json(['message'=> sizeof($prorest)]);
    if(sizeof($prorest))
    {
        $bd="Détails commande : 5 ".$prorest[0]->namepr.", Date de collecte le ";
        $tlt="Commande à traiter";
        $this->send_notification($bd,$tlt,$prorest[0]->token_frb);
    }

  }

  public function ListScannable(Request $req)
  {
    $listComm = DB::table('produits')
    ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
    ->join('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
    ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
    ->join('signatures', 'signatures.id', '=', 'detailcommandes.signatures_id')
    ->join('clients', 'clients.id', '=', 'commandes.clients_id')
    ->select(DB::raw('hour(detailcommandes.date_collecte) as hccom'),
     DB::raw('Minute(detailcommandes.date_collecte) as mccom'),'commandes.created_at as comcreated_at',
    'produits.id as idpr','produits.name as namepr','produits.description as descpr',DB::raw('hour(produits.started_at) as hdpr')
    ,DB::raw('hour(produits.finished_at) as hfpr'),DB::raw('Minute(produits.started_at) as mdpr'),'produits.prix as prixpr'
    ,'detailcommandes.qte as qtedet',DB::raw('Date(detailcommandes.date_collecte)as datecom'),'clients.name as namecl','clients.tel as telcl'
    ,DB::raw('Minute(produits.finished_at) as mfpr'),DB::raw('Date(produits.started_at) as started_at'),'signatures.id as idsg',
    'signatures.code as codesg','signatures.etat as etatsg',
    'signatures.created_at as created_atsg')
    ->where('signatures.code',$req->codeB)
    ->where('restaurants.id',$req->id)
    ->where('signatures.etat',0)
    ->orderBy('commandes.created_at','desc')
    ->get();
   return response()->json($listComm);  
  }

  public function Signerproduit(Request $req)
  {
      try
      {
      $sgn = DB::table('signatures')
      ->join('detailcommandes', 'detailcommandes.signatures_id', '=', 'signatures.id')
      ->join('produits', 'detailcommandes.produits_id', '=', 'produits.id')
      ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')

      ->select('signatures.id')
      ->where('signatures.code',$req->codeB)
      ->where('restaurants.id',$req->id)
      ->get();
      //dd($sgn[0]->id);
      if(sizeof($sgn)>0)
      {
      $Sgn = Signature::find($sgn[0]->id);
      $Sgn->etat=1;
      $Sgn->save();
      return Response()->json(["codeEr"=>"300","msg"=>"Signé"]);  
      }
      else
      return Response()->json(["codeEr"=>"303","msg"=>"introuvable"]);  
    } catch (\Exception  $ex) {
        DB::rollback();  
            return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);  
              } 
  }

    public function Sgnproduit(Request $req)
  {
      try
      {
      $sgn = DB::table('signatures')
      ->select('signatures.etat')
      ->where('signatures.code',$req->codeB)
      ->get();
      //dd($sgn[0]->id);
      if(sizeof($sgn)>0)
      {
      if($sgn[0]->etat==1)
      return Response()->json(["codeEr"=>"300","msg"=>"Signé"]);  
      else 
      return Response()->json(["codeEr"=>"301","msg"=>"non Signé"]);  
      }
      else
      return Response()->json(["codeEr"=>"303","msg"=>"introuvable"]);  
    } catch (\Exception  $ex) {
        DB::rollback();  
            return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);  
              } 
  }

  public function GetFavoris(Request $req)
  {
    try
    {
    $favoris = DB::table('favoris')
    ->join('clients', 'favoris.clients_id', '=', 'clients.id')
    ->join('restaurants', 'restaurants.id', '=', 'favoris.restaurants_id')
    ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
    ->select('restaurants.*','favoris.id as favoris','types.name as typename')
    ->where('clients.id',$req->id)
    ->get();
    //dd($sgn[0]->id);
    return response()->json($favoris);  
  } catch (\Exception  $ex) {
      DB::rollback();  
          return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);  
            } 
  }

  public function DeleteFavoris(Request $req)
  {
    try
    {
    $favoris = Favori::find($req->idfav);
    $favoris->delete();
    //dd($sgn[0]->id);
    return Response()->json(["codeEr"=>"300","msg"=>"Bien supprimer"]);
  } catch (\Exception  $ex) {
      DB::rollback();  
          return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);  
            } 
  }

public function ProdAproxi()
{
    try
    {
        $listRestaus = DB::table('restaurants')
        ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
        ->join('produits', 'produits.restaurants_id', '=', 'restaurants.id')
        ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->join('typeproduits', 'typeproduits.id', '=', 'produits.typeproduits_id')
        ->select('restaurants.id', 'restaurants.logo', 'restaurants.gerant', 'restaurants.tele', 'restaurants.localisations_id', 
        'restaurants.name', 'restaurants.email', 'restaurants.adresse', 'restaurants.password','produits.name as pr_name',
        'restaurants.etat', 'restaurants.token_frb', 'restaurants.verified_at', 'restaurants.created_at', 'restaurants.updated_at',
        'localisations.latitude as latitude','localisations.longitude as longitude','produits.description','produits.created_at'
        ,'typeproduits.name as pr_type','typeproduits.id as type_id','produits.id as id_pro','produits.qte as pr_qte',DB::raw('hour(produits.started_at) as hd')
        ,DB::raw('hour(produits.finished_at) as hf'),DB::raw('Minute(produits.started_at) as md'),DB::raw('Minute(produits.finished_at) as mf')
        ,DB::raw('Date(produits.started_at) as dd'),DB::raw('Date(produits.finished_at) as df'),DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'),'produits.place','produits.emporter','produits.libre','produits.livraison','produits.prixini','produits.prix')
        ->orderby('produits.created_at','desc')
        ->groupBy('restaurants.id', 'restaurants.logo', 'restaurants.gerant', 'restaurants.tele', 'restaurants.localisations_id', 
        'restaurants.name', 'restaurants.email', 'restaurants.adresse', 'restaurants.password','produits.created_at',
        'restaurants.etat', 'restaurants.token_frb', 'restaurants.verified_at', 'restaurants.created_at', 'restaurants.updated_at',
        'localisations.latitude','localisations.longitude','produits.name','produits.description'
        ,'typeproduits.name','typeproduits.id','produits.id','produits.qte',DB::raw('hour(produits.started_at)')
        ,DB::raw('hour(produits.finished_at)'),DB::raw('Minute(produits.started_at)'),DB::raw('Minute(produits.finished_at)'),DB::raw('Date(produits.started_at)'),DB::raw('Date(produits.finished_at)'),'produits.place','produits.emporter','produits.libre','produits.livraison','produits.prixini','produits.prix')
        ->get();
         return response()->json($listRestaus);
           } catch (\Exception  $ex)
           {
          DB::rollback();  
          return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);  
            } 
}
public function ProdAproxiCity(Request $req)
{
    try
    {
        $listRestaus = DB::table('restaurants')
        
        ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
        ->join('typerestaurants','restaurants.id','typerestaurants.restaurants_id')
      ->join('types', 'types.id', '=', 'typerestaurants.types_id')
        ->join('villes', 'villes.id', '=', 'restaurants.villes_id')
        ->join('produits', 'produits.restaurants_id', '=', 'restaurants.id')
        ->Leftjoin('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
        ->join('typeproduits', 'typeproduits.id', '=', 'produits.typeproduits_id')
        ->select('restaurants.id', 'typerestaurants.types_id', 'restaurants.logo', 'restaurants.gerant', 'restaurants.tele', 'restaurants.localisations_id', 
        'restaurants.name', 'restaurants.email', 'restaurants.adresse', 'restaurants.password','produits.name as pr_name',
        'restaurants.etat', 'restaurants.token_frb', 'restaurants.verified_at', 'restaurants.created_at', 'restaurants.updated_at',
        'localisations.latitude as latitude','localisations.longitude as longitude','types.name as nameType','produits.description'
        ,'typeproduits.name as pr_type','produits.id as id_pro','produits.qte as pr_qte',DB::raw('hour(produits.started_at) as hd')
        ,DB::raw('hour(produits.finished_at) as hf'),DB::raw('Minute(produits.started_at) as md'),DB::raw('Minute(produits.finished_at) as mf')
        ,DB::raw('Date(produits.started_at) as dd'),DB::raw('Date(produits.finished_at) as df'),DB::raw('IFNULL(sum(detailcommandes.qte),0) as vendu'),'produits.place','produits.emporter','produits.libre')
        ->groupBy('restaurants.id', 'typerestaurants.types_id', 'restaurants.logo', 'restaurants.gerant', 'restaurants.tele', 'restaurants.localisations_id', 
        'restaurants.name', 'restaurants.email', 'restaurants.adresse', 'restaurants.password',
        'restaurants.etat', 'restaurants.token_frb', 'restaurants.verified_at', 'restaurants.created_at', 'restaurants.updated_at',
        'localisations.latitude','localisations.longitude','types.name','produits.name','produits.description'
        ,'typeproduits.name','produits.id','produits.qte',DB::raw('hour(produits.started_at)')
        ,DB::raw('hour(produits.finished_at)'),DB::raw('Minute(produits.started_at)'),DB::raw('Minute(produits.finished_at)'),DB::raw('Date(produits.started_at)'),DB::raw('Date(produits.finished_at)'),'produits.place','produits.emporter','produits.libre')
       // ->where('villes.nom',$req->city)
        ->get();
         return response()->json($listRestaus);
  } catch (\Exception  $ex) {
      DB::rollback();  
          return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);  
            } 
}

    public function Deletefav(Request $req)
  {
      try
      {
      $favoris = DB::table('favoris')
      ->join('clients', 'favoris.clients_id', '=', 'clients.id')
      ->select('favoris.id')
      ->where('clients.id',$req->idclient)
      ->get();
      foreach($favoris as $fs)
      {
          $fvr = Favori::find($fs->id);
          $fvr->delete();
          
      }
  return Response()->json(["codeEr"=>"300","msg"=>"bien supprimer"]); 
    } catch (\Exception  $ex) {
        DB::rollback();  
            return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);  
              } 
  }
  
      public function GetVilles(Request $req)
  {
      try
      {
      $villes = DB::table('villes')
      ->join('pays', 'pays.id', '=', 'villes.pays_id')
      ->select('villes.*')
      ->where('pays.id',$req->idpays)
      ->get();
     $villes['codeEr']=300; 
  return Response()->json($villes); 
    } catch (\Exception  $ex) {
        DB::rollback();  
            return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);  
    } 
  }
  
  public function getTypeproduct(Request $req)
{ 
    try{
        //dd($req->input('idinput'));
        $Typeproduit= Typeproduit::all();
      return Response()->json($Typeproduit); 
}catch(QueryException $ex){ 
return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);
  }

}

  public function getType(Request $req)
{ 
    try{
        //dd($req->input('idinput'));
        $Type= Type::all();
      return Response()->json($Type); 
}catch(QueryException $ex){ 
return Response()->json(["codeEr"=>"304","msg"=>$ex->getMessage()]);
  }

}


}
