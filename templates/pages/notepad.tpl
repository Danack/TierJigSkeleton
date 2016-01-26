
{extends file="component/blankPage"}

{block name='content'}
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        
      <h2>
          Notepad
      </h2>
 
      <p></p>
        
      <form>
          <label for="data">Enter some text</label><br/>
          <input type='text' name="data" value='' size="100"/><br/>
          <div>&nbsp;</div>

          <button type="submit" name="submit" value="Submit">Add to notepad</button>
          <button type="submit" name="submit" value="Clear">Clear notepad</button>
      </form>

      {inject name='session' type='ASM\Session'}
      {$data = $session->getData()}
      {foreach $data as $key => $value}
          {$key} => {$value} <br/>
      {/foreach}
    
      

     </div>
   </div>
 </div>
{/block}