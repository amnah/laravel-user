<?php

class Profile extends Eloquent {

    /**
     * Validation errors
     * @var Illuminate\Support\MessageBag
     */
    public $validationErrors;

    /**
     * Constructor
     */
    public function __construct(array $attributes = array()) {
        $this->validationErrors = new \Illuminate\Support\MessageBag;
        parent::__construct($attributes);
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
     * Validate registration
     * @var array $data
     * @return bool
     */
    public function fillValidateRegister($data) {
        $rules = array(
            'first_name'  => 'alpha_num',
            'last_name'   => 'alpha_num',
        );
        return $this->fillValidate($rules, $data);
    }

    /**
     * Validate account
     * @var array $data
     * @return bool
     */
    public function fillValidateAccount($data) {
        $rules = array(
            'first_name'  => 'alpha_num',
            'last_name'   => 'alpha_num',
        );
        return $this->fillValidate($rules, $data);
    }

    /**
     * Validate admin creation
     * @var array $data
     * @return bool
     */
    public function fillValidateAdminCreate($data) {
        $rules = array(
            'first_name'  => 'alpha_num',
            'last_name'   => 'alpha_num',
        );
        return $this->fillValidate($rules, $data);
    }

    /**
     * Validate admin creation
     * @var array $data
     * @return bool
     */
    public function fillValidateAdminEdit($data) {
        $rules = array(
            'first_name'  => 'alpha_num',
            'last_name'   => 'alpha_num',
        );
        return $this->fillValidate($rules, $data);
    }

    /**
     * Set specified user
     * @param int $user_id
     * @return $this
     */
    public function setUser($user_id) {
        $this->setAttribute("user_id", $user_id);
        return $this;
    }

}