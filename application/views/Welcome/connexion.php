
<?= validation_errors(); ?>
<h1>Connexion</h1>

<?= form_open('Welcome/Connexion'); ?>
<h5>Username</h5>
<input type="text" name="username" value="" size="50"/>

<h5>Password</h5>
<input type="text" name="password" value="" size="50"/><br /><br />

<button type="submit">Connexion</button>
</form>


