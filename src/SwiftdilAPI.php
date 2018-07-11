<?php

namespace DogeDev\SwiftDil;

class SwiftdilAPI
{
    private $token;

    public function __construct()
    {
        return $this->token = (new Authenticate())->getToken();
    }

    /**
     * Instantiates Association class
     *
     * @return Association
     */
    public function Association()
    {
        return new Association($this->token);
    }

    /**
     * Instantiates Customer class
     *
     * @return Customer
     */
    public function Customer()
    {
        return new Customer($this->token);
    }

    /**
     * Instantiates Document class
     *
     * @return Document
     */
    public function Document()
    {
        return new Document($this->token);
    }

    /**
     * Instantiates DocumentVerification class
     *
     * @return DocumentVerification
     */
    public function DocumentVerification()
    {
        return new DocumentVerification($this->token);
    }

    /**
     * Instantiates File class
     *
     * @return File
     */
    public function File()
    {
        return new File($this->token);
    }

    /**
     * Instantiates IdentityVerifications class
     *
     * @return IdentityVerification
     */
    public function IdentityVerification()
    {
        return new IdentityVerification($this->token);
    }

    /**
     * Instantiates Match class
     *
     * @return Match
     */
    public function Match()
    {
        return new Match($this->token);
    }

    /**
     * Instantiates Note class
     *
     * @return Note
     */
    public function Note()
    {
        return new Note($this->token);
    }

    /**
     * Instantiates Report class
     *
     * @return Report
     */
    public function Report()
    {
        return new Report($this->token);
    }

    /**
     * Instantiates RiskProfile class
     *
     * @return RiskProfile
     */
    public function RiskProfile()
    {
        return new RiskProfile($this->token);
    }

    /**
     * Instantiates Screening class
     *
     * @return Screening
     */
    public function Screening()
    {
        return new Screening($this->token);
    }
}