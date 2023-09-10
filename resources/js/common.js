//現在の時刻を取得
const get_nowTime = () => {
    var now = new Date();
    var Year = now.getFullYear();
    var Month = now.getMonth() + 1;
    var date = now.getDate();
    var Hour = now.getHours();
    var Min = now.getMinutes();
    var Sec = now.getSeconds();

    return Year + '-' + Month + '-' + date + ' ' + Hour + ':' + Min + ':' + Sec;
}

//現在の時刻と比較してどれくらい前の投稿かを取得
const get_diffTime = (updated_time) => {
    var now = new Date(get_nowTime());
    var now_Year = now.getFullYear();
    var now_Month = now.getMonth() + 1;
    var now_date = now.getDate();
    var now_Hour = now.getHours();
    var now_Min = now.getMinutes();
    var now_Sec = now.getSeconds();

    var updated = new Date(updated_time);
    var updated_Year = updated.getFullYear();
    var updated_Month = updated.getMonth() + 1;
    var updated_date = updated.getDate();
    var updated_Hour = updated.getHours();
    var updated_Min = updated.getMinutes();
    var updated_Sec = updated.getSeconds();

    var ret_st = '';
    if(updated < now){
        if(updated_Year < now_Year){
            ret_st = (now_Year - updated_Year) + '年前'; 
        } else if(updated_Month < now_Month){
            ret_st = (now_Month - updated_Month) + 'ヶ月前';
        } else if(updated_date < now_date){
            ret_st = (now_date - updated_date) + '日前';
        } else if(updated_Hour < now_Hour){
            ret_st = (now_Hour - updated_Hour) + '時間前';
        } else if(updated_Min < now_Min) {
            ret_st = (now_Min - updated_Min) + '分前';
        } else if(updated_Sec < now_Sec){
            ret_st = (now_Sec - updated_Sec) + '秒前';
        }
    } else {
        ret_st = 'error';
    }

    return ret_st;
}


export { get_nowTime, get_diffTime }

//時刻を整形
const getDate_change_format = (date) => {
    var date = new Date(date);
    return date.getFullYear() + '年' + (date.getMonth() + 1) + '月' + date.getDate() + '日' + ' ' 
    + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
}

export {getDate_change_format}