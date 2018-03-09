Just a test of consistent hashing algorithm
-

Requirements
=
- PHP 7.*
- composer

How to run test
=
- composer install
- php -f index.php

Test stats
=
Calculated using internal test (so u can repeat) at one core:
```
2018-03-09T22:20:27+03:00 Array
(
    [$nodesStats (node name->objects count)] => Array
        (
            [node_0001] => 4935
            [node_0002] => 5112
            [node_0003] => 4934
            [node_0004] => 4936
            [node_0005] => 4948
            [node_0006] => 4894
            [node_0007] => 4912
            [node_0008] => 4949
            [node_0009] => 4965
            [node_0010] => 4952
            [node_0011] => 5152
            [node_0012] => 5038
            [node_0013] => 5025
            [node_0014] => 4916
            [node_0015] => 5068
            [node_0016] => 5006
            [node_0017] => 4939
            [node_0018] => 5011
            [node_0019] => 5093
            [node_0020] => 5063
            [node_0021] => 4995
            [node_0022] => 5047
            [node_0023] => 5036
            [node_0024] => 4920
            [node_0025] => 4940
            [node_0026] => 5050
            [node_0027] => 4838
            [node_0028] => 4835
            [node_0029] => 4993
            [node_0030] => 5101
            [node_0031] => 4991
            [node_0032] => 5016
            [node_0033] => 4927
            [node_0034] => 4862
            [node_0035] => 4934
            [node_0036] => 5022
            [node_0037] => 4942
            [node_0038] => 5087
            [node_0039] => 5032
            [node_0040] => 5020
            [node_0041] => 5089
            [node_0042] => 5157
            [node_0043] => 5013
            [node_0044] => 5056
            [node_0045] => 4996
            [node_0046] => 5054
            [node_0047] => 5087
            [node_0048] => 4931
            [node_0049] => 4913
            [node_0050] => 5009
            [node_0051] => 4956
            [node_0052] => 5098
            [node_0053] => 4981
            [node_0054] => 4959
            [node_0055] => 5173
            [node_0056] => 5111
            [node_0057] => 5071
            [node_0058] => 5137
            [node_0059] => 5032
            [node_0060] => 5069
            [node_0061] => 5071
            [node_0062] => 5020
            [node_0063] => 5064
            [node_0064] => 5003
            [node_0065] => 5027
            [node_0066] => 5045
            [node_0067] => 4889
            [node_0068] => 5026
            [node_0069] => 5058
            [node_0070] => 5113
            [node_0071] => 5022
            [node_0072] => 4869
            [node_0073] => 5051
            [node_0074] => 4955
            [node_0075] => 5054
            [node_0076] => 4950
            [node_0077] => 5071
            [node_0078] => 4974
            [node_0079] => 4920
            [node_0080] => 4953
            [node_0081] => 5015
            [node_0082] => 4940
            [node_0083] => 4840
            [node_0084] => 4985
            [node_0085] => 4990
            [node_0086] => 4980
            [node_0087] => 4993
            [node_0088] => 5154
            [node_0089] => 4986
            [node_0090] => 5160
            [node_0091] => 5066
            [node_0092] => 5135
            [node_0093] => 4995
            [node_0094] => 4984
            [node_0095] => 5037
            [node_0096] => 4970
            [node_0097] => 5028
            [node_0098] => 5019
            [node_0099] => 5073
            [node_0100] => 4947
            [node_0101] => 4956
            [node_0102] => 5005
            [node_0103] => 5030
            [node_0104] => 4867
            [node_0105] => 4981
            [node_0106] => 4876
            [node_0107] => 5047
            [node_0108] => 4979
            [node_0109] => 5022
            [node_0110] => 5119
            [node_0111] => 4875
            [node_0112] => 4988
            [node_0113] => 4937
            [node_0114] => 5026
            [node_0115] => 5016
            [node_0116] => 5096
            [node_0117] => 4930
            [node_0118] => 4968
            [node_0119] => 4972
            [node_0120] => 4969
            [node_0121] => 5002
            [node_0122] => 4945
            [node_0123] => 5036
            [node_0124] => 4996
            [node_0125] => 5112
            [node_0126] => 5081
            [node_0127] => 5091
            [node_0128] => 4910
            [node_0129] => 4996
            [node_0130] => 4998
            [node_0131] => 4978
            [node_0132] => 5000
            [node_0133] => 5006
            [node_0134] => 5039
            [node_0135] => 4971
            [node_0136] => 4892
            [node_0137] => 5015
            [node_0138] => 4972
            [node_0139] => 4985
            [node_0140] => 5007
            [node_0141] => 5103
            [node_0142] => 5058
            [node_0143] => 4930
            [node_0144] => 5073
            [node_0145] => 5154
            [node_0146] => 5017
            [node_0147] => 5054
            [node_0148] => 4890
            [node_0149] => 5028
            [node_0150] => 5020
            [node_0151] => 4944
            [node_0152] => 4941
            [node_0153] => 4924
            [node_0154] => 5057
            [node_0155] => 5096
            [node_0156] => 5075
            [node_0157] => 4961
            [node_0158] => 4872
            [node_0159] => 5099
            [node_0160] => 4946
            [node_0161] => 4962
            [node_0162] => 4964
            [node_0163] => 4921
            [node_0164] => 4977
            [node_0165] => 4942
            [node_0166] => 4962
            [node_0167] => 4953
            [node_0168] => 5019
            [node_0169] => 4986
            [node_0170] => 5164
            [node_0171] => 4949
            [node_0172] => 5010
            [node_0173] => 4861
            [node_0174] => 5016
            [node_0175] => 4867
            [node_0176] => 5118
            [node_0177] => 4946
            [node_0178] => 5020
            [node_0179] => 5065
            [node_0180] => 5019
            [node_0181] => 4920
            [node_0182] => 4830
            [node_0183] => 5093
            [node_0184] => 5035
            [node_0185] => 4921
            [node_0186] => 4942
            [node_0187] => 5005
            [node_0188] => 5041
            [node_0189] => 4829
            [node_0190] => 5066
            [node_0191] => 5009
            [node_0192] => 5046
            [node_0193] => 4977
            [node_0194] => 4963
            [node_0195] => 4966
            [node_0196] => 4999
            [node_0197] => 4998
            [node_0198] => 4987
            [node_0199] => 4984
            [node_0200] => 4975
        )

    [$slotsCount] => 100000
    [$nodesCount] => 200
    [$emulateObjects] => 1000000
    [min objects quantity per node] => 4829
    [max objects quantity per node] => 5173
    [memory_usage bytes] => 4 836 036 608
    [$preparationsFinishTime] => 75.472957849503
    [$objectsDistributionByNodesFinishTime] => 13.980341911316
)

```

P.S.
=
Implementation contains optimized binary search (O = log(value=x, base=2)), 
so it finds appropriate Node very fast even on huge number of slots. Brute algorithm have been left where it is to show difference.
