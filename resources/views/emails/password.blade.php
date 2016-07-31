Someone is attempting to reset your password for omusing.com. If it's not you, please disregard this email.<br /><br />

Click here to reset your password: {{ url('password/reset/'.$token) }}

<?php \Session::flash('success_message','Email sent.'); ?>