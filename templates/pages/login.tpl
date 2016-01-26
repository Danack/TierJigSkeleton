
{extends file="component/blankPage"}

{block name='content'}
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        
<h2>
    Jig
</h2>
 
{inject name='authBox' type='TierJigSkeleton\Site\AuthBox'}
{$authBox->render() | nofilter}
        
{inject name='userInfo' type='TierJigSkeleton\Site\UserInfo'}        
{$userInfo->render() | nofilter}

     </div>
   </div>
 </div>
{/block}