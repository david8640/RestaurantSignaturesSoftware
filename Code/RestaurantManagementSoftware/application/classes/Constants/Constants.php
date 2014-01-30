<?php

/* 
 *  <copyright file="Constants.php" company="RestaurantManagementSoftware">
 *     Copyright (c) 2013, 2014 All Right Reserved
 *  </copyright>
 *  <author>David Fortin</author>
 *  <date>2013-10-05</date>
 *  <summary>This class contains all the constants of the application.</summary>
 */
class Constants_Constants {
    // http://stackoverflow.com/questions/201323/using-a-regular-expression-to-validate-an-email-address/1917982#1917982
    const EmailRegex =
            '/(?(DEFINE)
                (?<address>         (?&mailbox) | (?&group))
                (?<mailbox>         (?&name_addr) | (?&addr_spec))
                (?<name_addr>       (?&display_name)? (?&angle_addr))
                (?<angle_addr>      (?&CFWS)? < (?&addr_spec) > (?&CFWS)?)
                (?<group>           (?&display_name) : (?:(?&mailbox_list) | (?&CFWS))? ;
                                                       (?&CFWS)?)
                (?<display_name>    (?&phrase))
                (?<mailbox_list>    (?&mailbox) (?: , (?&mailbox))*)

                (?<addr_spec>       (?&local_part) \@ (?&domain))
                (?<local_part>      (?&dot_atom) | (?&quoted_string))
                (?<domain>          (?&dot_atom) | (?&domain_literal))
                (?<domain_literal>  (?&CFWS)? \[ (?: (?&FWS)? (?&dcontent))* (?&FWS)?
                                              \] (?&CFWS)?)
                (?<dcontent>        (?&dtext) | (?&quoted_pair))
                (?<dtext>           (?&NO_WS_CTL) | [\x21-\x5a\x5e-\x7e])

                (?<atext>           (?&ALPHA) | (?&DIGIT))
                (?<atom>            (?&CFWS)? (?&atext)+ (?&CFWS)?)
                (?<dot_atom>        (?&CFWS)? (?&dot_atom_text) (?&CFWS)?)
                (?<dot_atom_text>   (?&atext)+ (?: \. (?&atext)+)*)

                (?<text>            [\x01-\x09\x0b\x0c\x0e-\x7f])
                (?<quoted_pair>     \\ (?&text))

                (?<qtext>           (?&NO_WS_CTL) | [\x21\x23-\x5b\x5d-\x7e])
                (?<qcontent>        (?&qtext) | (?&quoted_pair))
                (?<quoted_string>   (?&CFWS)? (?&DQUOTE) (?:(?&FWS)? (?&qcontent))*
                                     (?&FWS)? (?&DQUOTE) (?&CFWS)?)

                (?<word>            (?&atom) | (?&quoted_string))
                (?<phrase>          (?&word)+)

                # Folding white space
                (?<FWS>             (?: (?&WSP)* (?&CRLF))? (?&WSP)+)
                (?<ctext>           (?&NO_WS_CTL) | [\x21-\x27\x2a-\x5b\x5d-\x7e])
                (?<ccontent>        (?&ctext) | (?&quoted_pair) | (?&comment))
                (?<comment>         \( (?: (?&FWS)? (?&ccontent))* (?&FWS)? \) )
                (?<CFWS>            (?: (?&FWS)? (?&comment))*
                                    (?: (?:(?&FWS)? (?&comment)) | (?&FWS)))

                # No whitespace control
                (?<NO_WS_CTL>       [\x01-\x08\x0b\x0c\x0e-\x1f\x7f])

                (?<ALPHA>           [A-Za-z])
                (?<DIGIT>           [0-9])
                (?<CRLF>            \x0d \x0a)
                (?<DQUOTE>          ")
                (?<WSP>             [\x20\x09])
              )

              (?&address)/x';
    const BlankHash = '00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000';
    const PhoneRegex = '/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]‌​)\s*)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-‌​9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})$/';
}
