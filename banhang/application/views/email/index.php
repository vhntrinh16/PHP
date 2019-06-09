<!DOCTYPE html>
<html lang="en">

<body style="background:#e0ebeb">
	
<center><div class="container" style="margin-top: 50px">
<p>
	<span class="message">
		<?php echo $this->session->flashdata('email_sent') ?>
	</span>
</p>
<form action="<?php echo base_url();?>sendmail/send" method="post" >
	
  <div class="form-group">
  &ensp;&ensp;&ensp;&ensp;<label for="toemail"><b>To:</b></label>
         &ensp;<input type="email" id="to_email" name="to_email" class="form-control" placeholder="To Email" required style="border-radius:3px;
                                                                                                                            width:80%;height:25px">
  </div>
  <div class="form-group" style="margin-top:10px">
    <label for='subject'><b>Subject:</b></label>
    &ensp;<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required style="border-radius:3px;width:80%;height:25px">
  </div>
  <div class="form-group" style="margin-top:10px">
  &ensp;&ensp;<label for='body'><b>Body:</b></label>
  &ensp;<textarea  id="body" class="form-control" placeholder="body" name="message" style="border-radius:3px;width:80%;height:120px">
     </textarea>
   
  </div>
  <div class="form-group" style="margin-top:10px">
   <button type="submit" class="btn btn-outline-primary" style="border-radius:3px;height:30px"><i>Send</i></button>
  </div>

</form>

</div></center>