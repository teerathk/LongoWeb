<?php
    include '../php/template.php';
    $title = "4Cast Realty Group - Home Page";
    $keywords = "";
    $description = "";
    printHead($title, $keywords, $description);
?>

<article class="col1">
							<div class="pad2">
								<h2 class="pad_bot1 pad_top1">Contact Form</h2>
                                                                
 <?php
 $printForm = TRUE;
 if(isset($_POST['submitt'])){
     include '../php/sendMessage.php';
     $messageSent = sendMessage();
     if($messageSent==TRUE){
         print "<h3>Your message was sent</h3>";
         $printForm = FALSE;
     }
     else{
         print "<h3>Your message was not sent</h3>";
     }
 }

    if($printForm==TRUE) {
?>
								<form id="ContactForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<div>
										<div  class="wrapper">
											<span>Your Name:</span>
                                                                                        <input type="hidden" name="submitt" value="true" />
											<input type="text" class="input" name="name" value="<?php
                                                                                            if(isset($_POST['name'])){
                                                                                                print $_POST['name'];
                                                                                            }
                                                                                        ?>">
                                                                                        <?php
                                                                                            if(isset($_SESSION['error']['name'])){
                                                                                                ?>
                                                                                                    <br />
                                                                                                    <p class="errorMessage">
                                                                                                        <?php
                                                                                                            print $_SESSION['error']['name'];
                                                                                                            unset($_SESSION['error']['name']);
                                                                                                         ?>
                                                                                                    </p>
                                                                                                <?php
                                                                                            }
                                                                                        ?>
										</div>
										<div  class="wrapper">
											<span>Your E-mail:</span>
											<input type="text" class="input" name="email">
                                                                                        
                                                                                        <?php
                                                                                            if(isset($_SESSION['error']['email'])){
                                                                                                ?>
                                                                                                    <br />
                                                                                                    <p class="errorMessage">
                                                                                                        <?php
                                                                                                            print $_SESSION['error']['email'];
                                                                                                            unset($_SESSION['error']['email']);
                                                                                                         ?>
                                                                                                    </p>
                                                                                                <?php
                                                                                            }
                                                                                        ?>
										</div>
										<div  class="textarea_box">
											<span>Your Message:</span>
											<textarea name="message" cols="1" rows="1"></textarea>
                                                                                        
                                                                                        <?php
                                                                                            if(isset($_SESSION['error']['message'])){
                                                                                                ?>
                                                                                                    <br />
                                                                                                    <p class="errorMessage">
                                                                                                        <?php
                                                                                                            print $_SESSION['error']['message'];
                                                                                                            unset($_SESSION['error']['message']);
                                                                                                         ?>
                                                                                                    </p>
                                                                                                <?php
                                                                                            }
                                                                                        ?>
										</div>
										<span>&nbsp;</span>
										<a href="#" class="button" onClick="document.getElementById('ContactForm').reset()">Clear</a>
										<input type="submit" class="button" value="sumbit" />
									</div>

                                                                </form>
<?php
    }

 ?>                                                               
							</div>
						</article>
						<article class="col2">

						</article>
					</div>
					<div class="wrapper">
						<article class="col1">
							
							<div class="pad2">
                                                            <p style="">
                                                                
                                                            </p>
							</div>
						</article>

					</div>
				</section>
			</div>
		</div>
<?php
printFooter();
?>