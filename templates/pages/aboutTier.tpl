
{extends file="component/blankPage"}

{block name='content'}
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        
<h2>
    Tier
</h2>

<p>
<a href="https://github.com/danack/tier">Tier</a> is an application runner. It provides a way of 'wiring' up code to be executed in a powerful way that avoids having to write lots of 'infrastructure' code.
</p>

<h3>
    What is the difference between a framework and an application runner?
</h3>
<p>
    In the PHP world, frameworks such as Zend, Symfony or Laravel provide a lot of functionality:
</p>
<ul>
    <li>Configuration</li>
    <li>Bootstrapping from procedural into OO code</li>
    <li>Routing</li>
    <li>A plugin ecosystem</li>
    <li>Useful libraries in the framework iteself</li>
    <li>Executing the application</li>
</ul>

<p>
    Tier does only the last thing; executes the code you tell it to. Everything else is deliberately left out. This allows you to choose the best libraries to meet your needs, rather than being led down the path of using those provided by the framework.
</p>

<p>
    This does mean that there is probably a little more work in getting Tier setup that traditionl framworks and Tier. The payoff for using Tier comes from how incredibly light-weight it is, without the cognitive overhead or inflexibility that frameworks have.
</p>
        
<p>
    The documentation is being worked on.
</p>
     </div>
   </div>
 </div>
{/block}