<?php
include './vendor/autoload.php';

$provinceJson = '[
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "110000",
    "quhao": "",
    "shengji": "北京市(京)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "120000",
    "quhao": "",
    "shengji": "天津市(津)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "130000",
    "quhao": "",
    "shengji": "河北省(冀)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "140000",
    "quhao": "",
    "shengji": "山西省(晋)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "150000",
    "quhao": "",
    "shengji": "内蒙古自治区(内蒙古)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "210000",
    "quhao": "",
    "shengji": "辽宁省(辽)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "220000",
    "quhao": "",
    "shengji": "吉林省(吉)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "230000",
    "quhao": "",
    "shengji": "黑龙江省(黑)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "310000",
    "quhao": "",
    "shengji": "上海市(沪)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "320000",
    "quhao": "",
    "shengji": "江苏省(苏)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "330000",
    "quhao": "",
    "shengji": "浙江省(浙)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "340000",
    "quhao": "",
    "shengji": "安徽省(皖)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "350000",
    "quhao": "",
    "shengji": "福建省(闽)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "360000",
    "quhao": "",
    "shengji": "江西省(赣)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "370000",
    "quhao": "",
    "shengji": "山东省(鲁)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "410000",
    "quhao": "",
    "shengji": "河南省(豫)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "420000",
    "quhao": "",
    "shengji": "湖北省(鄂)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "430000",
    "quhao": "",
    "shengji": "湖南省(湘)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "440000",
    "quhao": "",
    "shengji": "广东省(粤)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "450000",
    "quhao": "",
    "shengji": "广西壮族自治区(桂)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "460000",
    "quhao": "",
    "shengji": "海南省(琼)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "500000",
    "quhao": "",
    "shengji": "重庆市(渝)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "510000",
    "quhao": "",
    "shengji": "四川省(川、蜀)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "520000",
    "quhao": "",
    "shengji": "贵州省(黔、贵)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "530000",
    "quhao": "",
    "shengji": "云南省(滇、云)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "540000",
    "quhao": "",
    "shengji": "西藏自治区(藏)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "610000",
    "quhao": "",
    "shengji": "陕西省(陕、秦)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "620000",
    "quhao": "",
    "shengji": "甘肃省(甘、陇)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "630000",
    "quhao": "",
    "shengji": "青海省(青)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "640000",
    "quhao": "",
    "shengji": "宁夏回族自治区(宁)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "650000",
    "quhao": "",
    "shengji": "新疆维吾尔自治区(新)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "810000",
    "quhao": "0852",
    "shengji": "香港特别行政区(港)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "820000",
    "quhao": "0853",
    "shengji": "澳门特别行政区(澳)",
    "xianji": ""
  },
  {
    "children": [],
    "diji": "",
    "quHuaDaiMa": "710000",
    "quhao": "",
    "shengji": "台湾省(台)",
    "xianji": ""
  }
]';
//数据来源 http://xzqh.mca.gov.cn/map
class Region
{
    private $client;
    private $region;

    public function __construct()
    {
        $this->client = new GuzzleHttp\Client();
    }

    public function run($provinceJson)
    {
        $provinceArr = json_decode($provinceJson, true);

        foreach ($provinceArr as $val) {
            $this->region[] = [
                'name' => $val['shengji'],
                'agency_id' => $val['quHuaDaiMa'],
                'parent_agency_id' => 0,
                'level' => 1,
            ];
            switch ($val['shengji']) {
                case '北京市(京)':
                    $this->region[] = [
                        'name' => '北京市',
                        'agency_id' => '110100',
                        'parent_agency_id' => $val['quHuaDaiMa'],
                        'level' => 2,
                    ];
                    $this->getArea([
                        'shengji' => $val['shengji'],
                        'diji' => '北京市',
                    ], '110100');
                    break;
                case '天津市(津)':
                    $this->region[] = [
                        'name' => '天津市',
                        'agency_id' => '120100',
                        'parent_agency_id' => $val['quHuaDaiMa'],
                        'level' => 2,
                    ];
                    $this->getArea([
                        'shengji' => $val['shengji'],
                        'diji' => '天津市',
                    ], '120100');
                    break;
                case '重庆市(渝)':
                    $this->region[] = [
                        'name' => '重庆市',
                        'agency_id' => '500100',
                        'parent_agency_id' => $val['quHuaDaiMa'],
                        'level' => 2,
                    ];
                    $this->getArea([
                        'shengji' => $val['shengji'],
                        'diji' => '重庆市',
                    ], '500100');
                    break;
                case '上海市(沪)':
                    $this->region[] = [
                        'name' => '上海市',
                        'agency_id' => '310100',
                        'parent_agency_id' => $val['quHuaDaiMa'],
                        'level' => 2,
                    ];
                    $this->getArea([
                        'shengji' => $val['shengji'],
                        'diji' => '上海市',
                    ], '310100');
                    break;
                default:
                    //$this->getCity($val['shengji'], $val['quHuaDaiMa']);
                    break;
            }
        }

        file_put_contents('./region.log', json_encode($this->region));
    }

    private function getCity($shengji, $quHuaDaiMa)
    {
        $form_params = [
            'shengji' => $shengji
        ];

        $result = $this->getData($form_params);

        foreach ($result as $val) {
            $this->region[] = [
                'name' => $val['diji'],
                'agency_id' => $val['quHuaDaiMa'],
                'parent_agency_id' => $quHuaDaiMa,
                'level' => 2,
            ];

            $this->getArea([
                'shengji' => $shengji,
                'diji' => $val['diji'],
            ], $val['quHuaDaiMa']);

            sleep(2);
        }
    }

    private function getArea($form_params, $quHuaDaiMa)
    {
        $result = $this->getData($form_params);

        foreach ($result as $val) {
            $this->region[] = [
                'name' => $val['xianji'],
                'agency_id' => $val['quHuaDaiMa'],
                'parent_agency_id' => $quHuaDaiMa,
                'level' => 3,
            ];
        }
    }

    private function getData($form_params)
    {
        $response = $this->client->request('POST', 'http://xzqh.mca.gov.cn/selectJson', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8',
            ],
            'form_params' => $form_params
        ]);

        $body = $response->getBody();

        sleep(1);

        return json_decode($body, true);
    }
}

(new Region())->run($provinceJson);