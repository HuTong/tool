# tool
工具

# 学习交流群
630730920

## Pagination 将分页独立出来使用
```
protected function getPagination($page_total = 1, $page_size = 1, $page_current = 1, $page_url, $show_pages = '')
{
    $page = new HuTong\Tool\Pagination();

    return $page->page_show($page_total, $page_size, $page_current, $page_url, $show_pages);
}
```

## sphinx
### 配置
```
source main
{
    type                    = mysql

    sql_host                = localhost
    sql_user                = root
    sql_pass                = root
    sql_db                  = station
    sql_port                = 3306  # optional, default is 3306
    sql_query_pre           = SET NAMES utf8
    sql_query_pre           = REPLACE INTO sph_counter SELECT 1, MAX(id) FROM images
    sql_query               = SELECT id, cid, title FROM images WHERE id <= (SELECT max_doc_id FROM sph_counter WHERE counter_id=1)

    sql_attr_uint           = cid
}

source delta : main
{
    sql_query_pre           = SET NAMES utf8
    sql_query               = SELECT id, cid, title FROM images WHERE id > (SELECT max_doc_id FROM sph_counter WHERE counter_id=1)
}

index main
{
    source                  = main
    path                    = /usr/local/sphinx/var/data/main

    docinfo                 = extern
    mlock                   = 0
    morphology              = none
    stopwords               =
    min_word_len            = 1
    min_prefix_len          = 0
    min_infix_len           = 0
    charset_table           = U+FF10..U+FF19->0..9, 0..9, U+FF41..U+FF5A->a..z, U+FF21..U+FF3A->a..z,A..Z->a..z, a..z, U+0149, U+017F, U+0138, U+00DF, U+00FF, U+00C0..U+00D6->U+00E0..U+00F6,U+00E0..U+00F6, U+00D8..U+00DE->U+00F8..U+00FE, U+00F8..U+00FE, U+0100->U+0101, U+0101,U+0102->U+0103, U+0103, U+0104->U+0105, U+0105, U+0106->U+0107, U+0107, U+0108->U+0109,U+0109, U+010A->U+010B, U+010B, U+010C->U+010D, U+010D, U+010E->U+010F, U+010F,U+0110->U+0111, U+0111, U+0112->U+0113, U+0113, U+0114->U+0115, U+0115, U+0116->U+0117,U+0117, U+0118->U+0119, U+0119, U+011A->U+011B, U+011B, U+011C->U+011D, U+011D,U+011E->U+011F, U+011F, U+0130->U+0131, U+0131, U+0132->U+0133, U+0133, U+0134->U+0135,U+0135, U+0136->U+0137, U+0137, U+0139->U+013A, U+013A, U+013B->U+013C, U+013C,U+013D->U+013E, U+013E, U+013F->U+0140, U+0140, U+0141->U+0142, U+0142, U+0143->U+0144,U+0144, U+0145->U+0146, U+0146, U+0147->U+0148, U+0148, U+014A->U+014B, U+014B,U+014C->U+014D, U+014D, U+014E->U+014F, U+014F, U+0150->U+0151, U+0151, U+0152->U+0153,U+0153, U+0154->U+0155, U+0155, U+0156->U+0157, U+0157, U+0158->U+0159, U+0159,U+015A->U+015B, U+015B, U+015C->U+015D, U+015D, U+015E->U+015F, U+015F, U+0160->U+0161,U+0161, U+0162->U+0163, U+0163, U+0164->U+0165, U+0165, U+0166->U+0167, U+0167,U+0168->U+0169, U+0169, U+016A->U+016B, U+016B, U+016C->U+016D, U+016D, U+016E->U+016F,U+016F, U+0170->U+0171, U+0171, U+0172->U+0173, U+0173, U+0174->U+0175, U+0175,U+0176->U+0177, U+0177, U+0178->U+00FF, U+00FF, U+0179->U+017A, U+017A, U+017B->U+017C,U+017C, U+017D->U+017E, U+017E, U+0410..U+042F->U+0430..U+044F, U+0430..U+044F,U+05D0..U+05EA, U+0531..U+0556->U+0561..U+0586, U+0561..U+0587, U+0621..U+063A, U+01B9,U+01BF, U+0640..U+064A, U+0660..U+0669, U+066E, U+066F, U+0671..U+06D3, U+06F0..U+06FF,U+0904..U+0939, U+0958..U+095F, U+0960..U+0963, U+0966..U+096F, U+097B..U+097F,U+0985..U+09B9, U+09CE, U+09DC..U+09E3, U+09E6..U+09EF, U+0A05..U+0A39, U+0A59..U+0A5E,U+0A66..U+0A6F, U+0A85..U+0AB9, U+0AE0..U+0AE3, U+0AE6..U+0AEF, U+0B05..U+0B39,U+0B5C..U+0B61, U+0B66..U+0B6F, U+0B71, U+0B85..U+0BB9, U+0BE6..U+0BF2, U+0C05..U+0C39,U+0C66..U+0C6F, U+0C85..U+0CB9, U+0CDE..U+0CE3, U+0CE6..U+0CEF, U+0D05..U+0D39, U+0D60,U+0D61, U+0D66..U+0D6F, U+0D85..U+0DC6, U+1900..U+1938, U+1946..U+194F, U+A800..U+A805,U+A807..U+A822, U+0386->U+03B1, U+03AC->U+03B1, U+0388->U+03B5, U+03AD->U+03B5,U+0389->U+03B7, U+03AE->U+03B7, U+038A->U+03B9, U+0390->U+03B9, U+03AA->U+03B9,U+03AF->U+03B9, U+03CA->U+03B9, U+038C->U+03BF, U+03CC->U+03BF, U+038E->U+03C5,U+03AB->U+03C5, U+03B0->U+03C5, U+03CB->U+03C5, U+03CD->U+03C5, U+038F->U+03C9,U+03CE->U+03C9, U+03C2->U+03C3, U+0391..U+03A1->U+03B1..U+03C1,U+03A3..U+03A9->U+03C3..U+03C9, U+03B1..U+03C1, U+03C3..U+03C9, U+0E01..U+0E2E,U+0E30..U+0E3A, U+0E40..U+0E45, U+0E47, U+0E50..U+0E59, U+A000..U+A48F, U+4E00..U+9FBF,U+3400..U+4DBF, U+20000..U+2A6DF, U+F900..U+FAFF, U+2F800..U+2FA1F, U+2E80..U+2EFF,U+2F00..U+2FDF, U+3100..U+312F, U+31A0..U+31BF, U+3040..U+309F, U+30A0..U+30FF,U+31F0..U+31FF, U+AC00..U+D7AF, U+1100..U+11FF, U+3130..U+318F, U+A000..U+A48F,U+A490..U+A4CF
    ngram_len = 1
    ngram_chars = U+4E00..U+9FBF, U+3400..U+4DBF, U+20000..U+2A6DF, U+F900..U+FAFF,U+2F800..U+2FA1F, U+2E80..U+2EFF, U+2F00..U+2FDF, U+3100..U+312F, U+31A0..U+31BF,U+3040..U+309F, U+30A0..U+30FF,U+31F0..U+31FF, U+AC00..U+D7AF, U+1100..U+11FF,U+3130..U+318F, U+A000..U+A48F, U+A490..U+A4CF
}

index delta : main
{
    source                  = delta
    path                    = /usr/local/sphinx/var/data/delta
}

indexer
{
    mem_limit               = 256M
}

searchd
{
    listen                  = 9312
    log                     = /usr/local/sphinx/var/log/searchd.log
    query_log               = /usr/local/sphinx/var/log/query.log
    read_timeout            = 5
    max_children            = 30
    pid_file                = /usr/local/sphinx/var/log/searchd.pid
    seamless_rotate         = 1
    preopen_indexes         = 1
    unlink_old              = 1
    workers                 = threads # for RT to work
    binlog_path             = /usr/local/sphinx/var/data
}
```
### 调用方法(cli)
```
use HuTong\Tool\Sphinx;

$sphinx = new Sphinx();

$word = isset($argv['1']) ? trim($argv['1']) : '美女';

print_r($sphinx->Query($word,'main'));

//print_r($sphinx->updateAttributes('main',array("look"),array(15=>array(66))));
```

## Selector
### 分析html数据信息 主要在采集数据的时候使用
```
$xpath = "//div[contains(@class,'design-goods-image-container')]//a//@href";
$alist = selector::select($html, $xpath);
```

## ArrXmlParse
### 解析数组、xml之间的相互转化
```
$array = array(
	'name' => 'zhangsan',
	'sex'  => 30,
	'list' => array(array('cname'=>'aa','bid'=>1),array('cname'=>'bb','bid'=>2))
);
echo ArrXmlParse::parseArr($array, 'root');
<?xml version="1.0" encoding="UTF-8"?>
<root>
  <name>zhangsan</name>
  <sex>30</sex>
  <list>
    <item>
      <cname>aa</cname>
      <bid>1</bid>
    </item>
    <item>
      <cname>bb</cname>
      <bid>2</bid>
    </item>
  </list>
</root>

$str = '<?xml version="1.0" encoding="UTF-8"?>
<root>
  <name>lisi</name>
  <sex>30</sex>
  <list>
    <item>
      <cname>aa</cname>
      <bid>1</bid>
    </item>
    <item>
      <cname>bb</cname>
      <bid>2</bid>
    </item>
  </list>
</root>';
print_r(ArrXmlParse::parseXml($str));
Array
(
    [name] => lisi
    [sex] => 30
    [list] => Array
        (
            [item] => Array
                (
                    [0] => Array
                        (
                            [cname] => aa
                            [bid] => 1
                        )

                    [1] => Array
                        (
                            [cname] => bb
                            [bid] => 2
                        )

                )

        )

)
```

## Validate
### 数据规则验证
```
1、数据验证
Validate::isMobile('18565101045');

2、表单验证
$vparams = array(
    array('input' => '18565101045', 'require' => true, 'message' => '手机号码不正确', 'validator' => 'isMobile'),
    array('input' => '18565101045@qq.com', 'require' => false, 'message' => '格式不正确', 'validator' => 'isEmail'),
);
print_r(Validate::form($vparams));
```
