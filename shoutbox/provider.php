<?php
$isp = $post['ip'];
if(preg_match('/202\.93\.(3[6-7])\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])/',$isp)){
echo'Indosat';
}elseif(preg_match('/203\.78\.(12[0-9]|11[0-9])\.(25[0-9]|2[0-9][0-9]|1[0-9][0-9]|[0-9][0-9]|[0-9])/',$isp)){
echo'Axis';
}elseif(preg_match('/202\.59\.174\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])/',$isp)){
echo'Three';
}elseif(preg_match('/202\.(15[0-9]|2[0-9][0-9])\.(24[0-9])\.(25[0-9]|2[0-9][0-9]|1[0-9][0-9]|[0-9][0-9]|[0-9])/',$isp)){
echo'XL';
}elseif(preg_match('/202\.70\.(6[0-3]|5[0-9]|4[8-9])\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])/',$isp)){
echo'Smart';
}elseif(preg_match('/202\.3\.(22[0-3]|21[0-9]|20[89])\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])/',$isp)){
echo'Telkomsel';
}elseif(preg_match('/221\.132\.(25[0-5]|2[0-4][0-9]|19[2-9])\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])/',$isp)){
echo'Telkomsel';
}elseif(preg_match('/202\.152\.(9[0-5]|[7-8][0-9]|6[4-9])\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])/',$isp)){
echo'Simpur Brunei';
}elseif(preg_match('/202\.160\.(4[0-7]|3[2-9])\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])/',$isp)){
echo'Brunet';
}elseif(preg_match('/125\.(16[0-3])\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])/',$isp)){
echo'Tel Speedy';
}elseif(preg_match('/222\.124\.(12[0-9]|1[0-9][0-9]|[7-9][0-9]|6[0-9])\.(25[0-9]|2[0-9][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])/',$isp)){
echo'Tel Speedy';
}elseif(preg_match('/212\.204\.254\.([0-9]|1[0-9])/',$isp)){
echo'Phonifier';
}elseif(preg_match('/205\.188\.242\.([0-9]|1[0-9])/',$isp)){
echo'Aol';
}elseif(preg_match('/193\.46\.236\.(1[0-9][0-9])/',$isp)){
echo'Bwap';
}elseif(preg_match('/69\.28\.226\.([0-9][0-9])/',$isp)){
echo'Ocean';
}elseif(preg_match('/203\.130\.([0-9][0-9]|[0-9][0-9][0-9])\.([0-9][0-9]|[0-9][0-9][0-9])/',$isp)){
echo'Tel Instan';
}elseif(preg_match('/212\.200\.65\.([0-9][0-9]|[0-9][0-9][0-9])/',$isp)){
echo'Tel Instan';
}elseif(preg_match('/223\.255\.(2[0-9][0-9])\.([0-9]|[0-9][0-9]|[0-9][0-9][0-9])/',$isp)){
echo'Three';
}elseif(preg_match('/103\.10\.(6[0-9])\.([0-9][0-9]|[0-9][0-9][0-9])/',$isp)){
echo'Three';
}elseif(preg_match('/112\.215\.(3[0-9])\.(1[0-9][0-9]|[0-9][0-9])/',$isp)){
echo'XL';
}elseif(preg_match('/182\.([0-9])\.([0-9][0-9][0-9]|[0-9][0-9])\.([0-9][0-9]|[0-9][0-9][0-9])/',$isp)){
echo'Telkomsel';
}elseif(preg_match('/114\.(1[0-9][0-9])\.([0-9][0-9][0-9]|[0-9][0-9]|[0-9])\.([0-9]|[0-9][0-9]|[0-9][0-9][0-9])/',$isp)){
echo'Telkomsel';
}elseif(preg_match('/39\.(2[0-9][0-9])\.([0-9]|[0-9][0-9]|[0-9][0-9][0-9])\.([0-9][0-9]|[0-9][0-9][0-9]|[0-9])/',$isp)){
echo'Telkomsel';
}elseif(preg_match('/118\.([0-9][0-9][0-9]|[0-9]|[0-9][0-9])\.([0-9]|[0-9][0-9]|[0-9][0-9][0-9])\.([0-9][0-9]|[0-9][0-9][0-9]|[0-9])/',$isp)){
echo'[Telkom Speedy]';
}elseif(preg_match('/(6[0-9])\.([0-9][0-9]|[0-9][0-9][0-9]|[0-9])\.([0-9][0-9]|[0-9][0-9][0-9]|[0-9])\.([0-9][0-9]|[0-9][0-9][0-9]|[0-9])/',$isp)){
echo'GOOGLEBOT';
}elseif(preg_match('/61\.5\.([0-9][0-9]|[0-9][0-9][0-9]|[0-9])\.([0-9][0-9]|[0-9][0-9][0-9]|[0-9])/',$isp)){
echo'Telkomnet';
}else{
echo'Gretongan';
}
?>
