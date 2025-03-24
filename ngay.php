<select id="ngay">
    <option value="0">Chọn ngày</option>
    <?php
        for($i=1;$i<=31;$i++){
            echo "<option value='$i'>Ngày $i</option>";
        }
    ?>
</select>
<select id="thang">
    <option value="0">Chọn tháng</option>
    <?php
        for($i=1;$i<=12;$i++){
            echo "<option value='$i'>Tháng $i</option>";
        }
    ?>
</select>
<select id="nam">
    <option value="0">Chọn năm</option>
    <?php
        for($i=1899;$i<=2025;$i++){
            echo "<option value='$i'>Năm $i</option>";
        }
    ?>
</select>