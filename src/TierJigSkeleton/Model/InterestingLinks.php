<?php

namespace TierJigSkeleton\Model;

class InterestingLinks
{
    private $links = [];
    
    public function __construct()
    {
        $this->links['http://chat.stackoverflow.com/rooms/11/php'] = "Room 11";
        $this->links['https://www.google.com'] = "Teh googlez";
        $this->links['http://tywkiwdbi.blogspot.co.uk/'] = "TYWKIWDBI";
    }

    public function render()
    {
        $output = '';
        
        foreach ($this->links as $uri => $description) {
            $output .= sprintf(
                "<a href='%s'> %s</a><br/>",
                $uri,
                $description
            );
        }
        
        return $output;
    }
}
