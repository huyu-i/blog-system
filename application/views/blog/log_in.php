
<?php echo validation_errors(); ?>

<?= form_open('BS_User/log_in') ?>

	<label for="email">邮箱</label>
	<input type="input" name="email" /><br />

	<label for="password">密码</label>
	<input type="password" name="password" /><br />

	<button name="submit" onclick="cmdRSAEncrypt()" >登陆</button>

</form>


<a href="uRegister">>>注册</a>

<script src="../../jsencrypt.js"></script>

<script>
function cmdRSAEncrypt (){

	let key='-----BEGIN PUBLIC KEY-----';
	key+='MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCytYlGIkLH8Vp6FY72PSfjnlkw';
	key+='IkR6r8Iw6DJvSwVil8ww88hNx3sf86CeE1ttoyIJO1jV52Oijr6P5cvtG3oG9J0U';
	key+='Lp+wrJmtiEBJkAKuK/45+D65boBKrI8ye/AGiQe0tm611JVGDMFyBJUKlAVQjsrk';
	key+='kjf93uzY562B448U4QIDAQAB';
	key+='-----END PUBLIC KEY-----';

	let Encrypt = new JSEncrypt();
	Encrypt.setPublicKey(key);

	let encrypted = Encrypt.encrypt(JSON.stringify({"encrypt": "true", "password": document.getElementsByName('password')[0].value}));

	// alert(Encrypt.encrypt(document.getElementsByName('password')[0].value));
	document.getElementsByName('password')[0].value = encrypted;
	alert("wait");
}
</script>
