      <div align="center"> 
       <?php //include("html5.php"); ?>
      </div> 
      
           
      <form name="html5frm" action="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=html5video_playlist&action=preview&id=<?php echo $_REQUEST['id']; ?>" method="post">
      
      <table width="50%" border="0" cellspacing="3" cellpadding="3">
            <tr>
            
                               
            <td>Player Size:</td>
            <td><select name="size">
                    
                        <?php /*?><option value="small" <?php if($size=="small") { ?> selected="selected" <?php } ?>>Small Player - no playlist</option><?php */?>
                        <option value="full" <?php if($size=="full") { ?> selected="selected" <?php } ?>>Full Player (Horizontal) - xml playlist</option>
                        <option value="big" <?php if($size=="big") { ?> selected="selected" <?php } ?>>Big Player (Vertical) - xml playlist</option>
                    
                    </select></td>
            
            </tr><tr>        
            
            
            <td>Title Scrolling:</td>
            <td><input type="checkbox" name="stitle"  value="1" <?php if(isset($stitle) && $stitle=='1') echo 'checked="checked"'; ?>  /></td>
            
            </tr><tr>
             
            <td>Width:</td>
            <td><input type="text" name="width"  value="<?=$width?>" style="width:30px;" />&nbsp;px</td>             
            
            
            </tr><tr>
            
            <td>Height:</td>
            <td><input type="text" name="height"  value="<?=$height?>" style="width:30px;" />&nbsp;px</td>
            
            </tr><tr>
            
            <td>Social Links:</td>
            <td><input type="checkbox" name="links"  value="1" <?php if(isset($links) && $links=='1') echo 'checked="checked"'; ?>  /></td>
            
            </tr><tr>
            
            <td>Frame Color:</td>
            <td>#&nbsp;<input class="color" name="fcolor" type="text" value="<?php echo $fcolor; ?>" /></td>
            
            </tr><tr>
            
            <td>Background Color:</td>
            <td>#&nbsp;<input class="color" name="bcolor" type="text" value="<?php echo $bcolor; ?>" /></td>
            
            
            </tr><tr>
            
            <td>Text Color:</td>
            <td>#&nbsp;<input class="color" name="tcolor1" type="text" value="<?php echo $tcolor1; ?>" />#&nbsp;<input class="color" name="tcolor2" type="text" value="<?php echo $tcolor2; ?>" /></td>
            
            
            
            </tr><tr>
            
            <td>Download Icon:</td>
            <td><input name="dlicon" type="text" value="<?php echo $dlicon; ?>" /></td>
            
            
            </tr><tr>
            
            <td>Download Icon Position:</td>
            <td><input name="dlpos" type="text" value="<?php echo $dlpos; ?>" /> (From Right)</td>
            
            
            
            
            </tr><tr>
            
            <td>&nbsp;</td>
            <td><input type="submit" name="go" value="Get Code" style="background-color:#D84937; height:35px; color:#ffffff; font-weight:bold;" /></td>
      
 
        </tr>
        </table>
        
        
        
        
   
   </form>
        
      
			<?php
            
            $url = 'http://html5.svnlabs.com/html5plus/html5.php?id='.$id.'&host='.$host.'&size='.$size.'&width='.$width.'&height='.$height.'&links='.$links.'&stitle='.$stitle.'&fcolor='.$fcolor.'&bcolor='.$bcolor.'&tcolor1='.$tcolor1.'&tcolor2='.$tcolor2.'&dlicon='.$dlicon.'&dlpos='.$dlpos;
			
            $uid = ' id="'.$id.'"';
            $w = ' width="'.$width.'"';
			$h = ' height="'.$height.'"';
            $cc = ' fcolor="'.$fcolor.'"';
			$bcc = ' bcolor="'.$bcolor.'"';
			$tcc1 = ' tcolor1="'.$tcolor1.'"';
			$tcc2 = ' tcolor2="'.$tcolor2.'"';
			$dlicon = ' dlicon="'.$dlicon.'"';
			$dlpos = ' dlpos="'.$dlpos.'"';
            $ll = ' links="'.$links.'"';
			$sl = ' stitle="'.$stitle.'"';
			$sz = ' size="'.$size.'"';
			
			
			//$scode = "[html5video ".$uid.$w.$h.$cc.$bcc.$tcc1.$tcc2.$dlicon.$dlpos.$ll.$sl.$sz."]";
			
			$scode = "[html5video ".$uid."]";
            
            
            $script = '<script type="text/javascript">'.$uid.';'.$w.';'.$h.';'.$cc.';'.$bcc.';'.$tcc1.';'.$tcc2.';'.$dlicon.';'.$dlpos.';'.$ll.';'.$sl.';'.$sz.';'.'</script><script type="text/javascript" src="http://html5.svnlabs.com/html5plus/html5.js"></script>';
            $iframe = '<iframe src="' . $url . '" frameborder="0" scrolling="no" height="'.$height.'" width="'.$width.'"></iframe>';
			
            
            ?>
            
            <div><?php //echo $iframe; ?></div>
            
            <?php //if(isset($_REQUEST['go']) && $_REQUEST['go']=="Get widget"){ ?>
            
            <table width="50%" border="0" cellspacing="3" cellpadding="3">
            <tr>
            
            <td><strong>Wordpress Shortcode</strong><br />
            <hr />
            <textarea cols="60" rows="10" onFocus="this.select();" style="border:1px dotted #343434" ><?php echo $scode; ?></textarea></td>
            <td>
            
            
            <td><strong>JavaScript Widget</strong><br />
            <hr />
            <textarea cols="60" rows="10" onFocus="this.select();" style="border:1px dotted #343434" ><?php echo "Upgrade to paid version...."; //$script; ?></textarea></td>
            <td>
            
            <strong>iFrame Widget</strong><br />
            <hr />
            <textarea cols="60" rows="10" onFocus="this.select();" style="border:1px dotted #343434" ><?php echo "Upgrade to paid version...."; //$iframe; ?></textarea>
            
            </td>
            
            </tr>
            </table>
            
            <?php //} ?>
            