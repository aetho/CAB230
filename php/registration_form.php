
<form class="form" id="sign-up-form">
    <div class="form-field" id="first-name-field">
        <label class="h5">First Name</label>
        <input type="text" placeholder="John" class="text-only-input required-input">
        <div class="form-error"></div>
    </div>
    <div class="form-field" id="last-name-field">
        <label class="h5">Last Name</label>
        <input type="text" placeholder="Smith" class="text-only-input required-input">
        <div class="form-error"></div>
    </div>
    <div class="form-field" id="email-field">
        <label class="h5">Email</label>
        <input type="text" placeholder="john@email.com" class="email-input required-input">
        <div class="form-error"></div>
    </div>
    <div class="form-field" id="password-field">
        <label class="h5">Password</label>
        <input type="password" placeholder="Password" class="password-input required-input">
        <div class="form-error"></div>
    </div>
    <div class="form-field" id="password-confirm-field">
        <label class="h5">Confirm Password</label>
        <input type="password" placeholder="Confirm password" class="password-confirm-input required-input">
        <div class="form-error"></div>
    </div>
    <div class="form-field" id="submit-field">
        <input type="submit" value="Sign up" onclick="ValidateForm('sign-up-form'); return false;">
    </div>
</form>