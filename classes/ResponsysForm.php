<?php

class ResponsysForm
{

    private $respondent;
    private $referringlink;
    private $id;

    public function __construct($respondent, $id, $referringlink = null)
    {
        $this->respondent = $respondent;
        $this->id = $id;
        $this->referringlink = $referringlink;
    }

    public function submit($data)
    {
        if ($this->id)
            $data['_ID_'] = $this->id;
        if ($this->referringlink)
            $data['REFERRINGLINK'] = $this->referringlink;

        $ch = curl_init($this->respondent);
        // set up cURL
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false
          )
        );

        // Now we need to send the fields over to them
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Always set this to fail and then update after success
        $curl_completed = false;

        for ($i = 0; $i < 3 && !$curl_completed; $curl_completed = curl_exec($ch), $i++)
            ;

        if ($curl_completed) {
            // Successfully submitted, set the return variable
            $final = 1;
        } else {
            // Error submitting data so now what
            $final = 0;
        }
        //close out the connection
        curl_close($ch);


        return $final;
    }

}

