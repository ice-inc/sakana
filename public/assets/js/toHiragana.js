(function($) {
    $.extend({
        replaceAll: function replaceAll(strOrgnal, strSearch, strReplac) {
            /// <summary>
            /// 全置換え
            ///
            /// strOrgnal : 対象の文字列
            /// strSearch : 検索文字
            /// strReplac : 置換え文字
            /// </summary>

            return strOrgnal.split(strSearch).join(strReplac);
        },

        toHiragana: function toHiragana(strOrgnal) {
            /// <summary>
            /// カタカナを平仮名（ヵ、ヶは変換せず：「ヴ」は「ぶ」に変換）
            /// strOrgnal : 対象の文字列
            /// </summary>

            // 「ヴ」は「ぶ」に変換
            var temporary = $.replaceAll(strOrgnal, "ヴ", "ぶ");

            var i, c, a = [];
            for(i=temporary.length-1; 0<=i; i--) {
                c = temporary.charCodeAt(i);
                if (0x30A1 <= c && c <= 0x30F3) {
                    // 0x30F4:ヴ
                    // 0x30F5:ヵ
                    // 0x30F6:ヶ
                    a[i] = c - 0x0060;
                }
                else {
                    a[i] = c;
                }
            }

            return String.fromCharCode.apply(null, a);
        }
    });
})(jQuery);