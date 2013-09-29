<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * Inactive status
     */
    const STATUS_INACTIVE = 0;

    /**
     * Active status
     */
    const STATUS_ACTIVE = 1;

    /**
     * Validation errors
     * @var Illuminate\Support\MessageBag
     */
    public $validationErrors;

    /**
     * The attributes excluded from the model"s JSON form.
     *
     * @var array
     */
    protected $hidden = array("password","token");

    /**
     * Constructor
     */
    public function __construct(array $attributes = array()) {
        $this->validationErrors = new \Illuminate\Support\MessageBag;
        parent::__construct($attributes);
    }

    /**
     * Set relationship to profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile() {
        return $this->hasOne("Profile");
    }

    /**
     * Set relationship to role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() {
        return $this->belongsTo("Role");
    }

    /**
     * Check permission
     * @param string $perm
     * @return bool
     */
    public function perm($perm) {
        $result = $this->role->$perm;
        return (bool)$result;
    }

    /**
     * Fill and validate based on rules
     * Allow empty rules to be fillable
     *
     * @var array $inputRules
     * @var array $inputData
     * @return bool
     */
    public function fillValidate($inputRules, $inputData) {

        // process input rules
        $fillableAttributes = array();
        $rules = array();
        foreach ($inputRules as $attribute => $rule) {

            // add to fillable attributes
            $fillableAttributes[] = $attribute;

            // add rule if not empty
            $rule = trim($rule, " |:,");
            if ($rule) {
                $rules[$attribute] = $rule;
            }
        }

        // fill in data
        $this->fillable = $fillableAttributes;
        $this->fill($inputData);

        // create validator and run
        $validator = Validator::make($this->attributes, $rules);
        $success = $validator->passes();

        // set messages before returning
        $this->validationErrors = $validator->messages();
        return $success;
    }

    /**
     * Fill and validate for registration
     * @var array $data
     * @return bool
     */
    public function fillValidateRegistration($data) {
        $table = $this->getTable();
        $rules = array(
            "email"       => "required|email|unique:{$table}",
            "username"    => "required|alpha_num|unique:{$table}",
            "password"    => "required|min:3",
        );
        return $this->fillValidate($rules, $data);
    }

    /**
     * Fill and validate for reset
     * @param array $data
     * @return bool
     */
    public function fillValidateReset($data) {
        $rules = array(
            "password"               => "required|min:3|confirmed",
            "password_confirmation"  => "required"
        );
        return $this->fillValidate($rules, $data);
    }

    /**
     * Fill and validate for account
     * @var array $data
     * @return bool
     */
    public function fillValidateAccount($data) {
        $table = $this->getTable();
        $rules = array(
            "oldPassword" => "",
            "email"       => "required|email|unique:{$table},email,{$this->id}",
            "username"    => "required|alpha_num|unique:{$table},username,{$this->id}",
            "password"    => "min:3|confirmed",
            "password_confirmation" => "",
        );
        return $this->fillValidate($rules, $data);
    }

    /**
     * Modified save
     * @var array $options
     * @return bool
     */
    public function save(array $options = array()) {

        // trim fillable fields
        foreach ($this->fillable as $attribute) {
            $this->$attribute = trim($this->$attribute);
        }

        // set old password if user left empty
        if (empty($this->password)) {
            $this->password = $this->getOriginal("password");
        }
        // hash new password
        elseif ($this->isDirty("password")) {
            $this->password = Hash::make($this->password);
        }

        // unset temp fields
        $unsetFields = array("oldPassword","password_confirmation");
        foreach ($unsetFields as $unsetField) {
            if (isset($this->attributes[$unsetField])) {
                unset($this->attributes[$unsetField]);
            }
        }

        return parent::save($options);
    }

    /**
     * Generate a token for the user
     * @return $this
     */
    public function generateToken() {
        // create random 32 character token
        $this->token = hash("sha1", $this->email . uniqid());
        return $this;
    }

    /**
     * Remove token
     * @return $this
     */
    public function removeToken() {
        $this->token = null;
        return $this;
    }

    /**
     * Set default AR fields (for registration)
     * @param int $roleId
     * @param int $status
     * @return $this
     */
    public function setDefaults($roleId, $status) {
        $this->role_id = $roleId;
        $this->status = $status;
        return $this;
    }

    /**
     * Set status field
     * @param int $status
     * @return $this
     */
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }





    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }
}