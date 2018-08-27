<?php

namespace DogeDev\SwiftDil;

class SwiftDilAPI
{
    protected $token;
    protected $url;

    public function __construct($clientId, $clientSecret, $url)
    {
        $this->token = (new Authenticate($clientId, $clientSecret, $url))->getToken();
        $this->url = $url;
    }

    /**
     * Instantiates Association class
     *
     * @return Association
     */
    public function Association()
    {
        return new Association($this->url, $this->token);
    }

    /**
     * Instantiates Customer class
     *
     * @return Customer
     */
    public function Customer()
    {
        return new Customer($this->url, $this->token);
    }

    /**
     * Instantiates Document class
     *
     * @return Document
     */
    public function Document()
    {
        return new Document($this->url, $this->token);
    }

    /**
     * Instantiates DocumentVerification class
     *
     * @return DocumentVerification
     */
    public function DocumentVerification()
    {
        return new DocumentVerification($this->url, $this->token);
    }

    /**
     * Instantiates File class
     *
     * @return File
     */
    public function File()
    {
        return new File($this->url, $this->token);
    }

    /**
     * Instantiates IdentityVerifications class
     *
     * @return IdentityVerification
     */
    public function IdentityVerification()
    {
        return new IdentityVerification($this->url, $this->token);
    }

    /**
     * Instantiates Match class
     *
     * @return Match
     */
    public function Match()
    {
        return new Match($this->url, $this->token);
    }

    /**
     * Instantiates Note class
     *
     * @return Note
     */
    public function Note()
    {
        return new Note($this->url, $this->token);
    }

    /**
     * Instantiates Report class
     *
     * @return Report
     */
    public function Report()
    {
        return new Report($this->url, $this->token);
    }

    /**
     * Instantiates RiskProfile class
     *
     * @return RiskProfile
     */
    public function RiskProfile()
    {
        return new RiskProfile($this->url, $this->token);
    }

    /**
     * Instantiates Screening class
     *
     * @return Screening
     */
    public function Screening()
    {
        return new Screening($this->url, $this->token);
    }
}