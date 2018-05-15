<?php

namespace OU;

class RequestId
{
    protected $id;

    /**
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->reset($id);
    }

    /**
     * @param string $id
     */
    public function reset($id = null)
    {
        $this->id = $id ?? 'REQ-' . bin2hex(random_bytes(16));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id;
    }
}
