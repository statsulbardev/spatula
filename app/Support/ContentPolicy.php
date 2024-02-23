<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;
use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;
use Spatie\Csp\Keyword;

class ContentPolicy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this->addDirective(Directive::STYLE, 'https://fonts.googleapis.com', Keyword::SELF);
        $this->addDirective(Directive::FONT, 'https://fonts.gstatic.com', Keyword::SELF);

        // $this->addDirective(Directive::IMG, 'https://*.googleapis.com', Keyword::SELF);
        // $this->addDirective(Directive::IMG, 'https://*.gstatic.com', Keyword::SELF);
        // $this->addDirective(Directive::IMG, '*.googleusercontent.com', Keyword::SELF);
        $this->addDirective(Directive::IMG, 'https://drive.google.com', Keyword::SELF);
        $this->addDirective(Directive::IMG, '*.googleusercontent.com', Keyword::SELF);
        $this->addDirective(Directive::IMG, 'https://community.bps.go.id', Keyword::SELF);
        $this->addDirective(Directive::IMG, 'https://simpeg.bps.go.id', Keyword::SELF);
        $this->addDirective(Directive::FORM_ACTION, 'https://sso.bps.go.id', Keyword::SELF);
        // $this->addDirective(Directive::IMG, 'https://drive.google.com', Keyword::SELF);
    }
}
