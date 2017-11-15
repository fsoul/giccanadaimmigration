<?php $imageURI = get_template_directory_uri() . '/public/images/mails/'; ?>
<table style="width:100%;border-spacing:0;border-collapse:collapse;">
    <tbody>
    <tr style="font-weight:bold;">
        <td style="color:#fff;font-family:'Lato',sans-serif;padding-top:20px;">
            <table>
                <tr>
                    <td style="color:#fff;font-family:'Lato',sans-serif;font-size:.8rem;">
                        <p style="margin:0;">Остались вопросы? Звоните!</p>
                        <p style="margin:0;padding-bottom:20px">
                            <span style="display:block;">Call center <a
                                        style="color:#fff;text-decoration:none;font-size:.7rem;white-space:nowrap;"
                                        href="tel:+16475584910">+16475584910</a></span>
                            <span style="display:block;">Israel <a
                                        style="color:#fff;text-decoration:none;font-size:.7rem;" href="tel:+0336738333">033-6738333, </a>
                                <a style="color:#fff;text-decoration:none;font-size:.7rem;white-space:nowrap;"
                                   href="tel:+0543319797">054-3319797</a>
                            </span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="color:#fff;font-family:'Lato',sans-serif;font-size:.8rem;">
                        <p style="margin:0;">Отдел продаж:</p>
                        <a href="mailto:Info@giccanadaimmigration.com"
                           style="margin:0;padding-bottom:20px;display:block;color:#fff;font-size:.63rem;text-decoration:none">Info@giccanadaimmigration.com</a>
                    </td>
                </tr>
                <tr>
                    <td style="color:#fff;font-family:'Lato',sans-serif;font-size:.8rem;">
                        <p style="margin:0;">Отдел обслуживания:</p>
                        <a href="mailto:development.gic@gmail.com"
                           style="margin:0;display:block;color:#fff;text-decoration:none;font-size:.63rem;">development.gic@gmail.com</a>
                        <a href="mailto:gicinfocenter2@gmail.com"
                           style="margin:0;display:block;color:#fff;text-decoration:none;font-size:.63rem;">gicinfocenter2@gmail.com</a>
                    </td>
                </tr>
            </table>
        </td>
        <td style="color:#fff;font-family:'Lato',sans-serif;padding-top:20px;vertical-align:top;">
            <table>
                <tr>
                    <td style="color:#fff;font-family:'Lato',sans-serif;font-size:.8em;">
                        <p style="color:#fff;margin:0;font-size:.8rem;">Aventura, FL 33180 APT 1410, USA</p>
                    </td>
                </tr>
                <tr>
                    <td style="color:#fff;font-family:'Lato',sans-serif;">
                        <p style="margin:0;display:block;color:#fff;text-decoration:none;font-size:.8rem;">Украина</p>
                        <p style="margin:0;display:block;color:#fff;text-decoration:none;font-size:.8rem;">714а,
                            ул.Антоновича
                            172, Киев, Украина</p>
                        <p style="color:#fff;margin:0;padding-bottom:20px;font-size:.8rem;">Бизнес центр Палладиум, 7
                            этаж офис,
                            719а</p>
                    </td>
                </tr>
                <tr>
                    <td style="color:#fff;font-family:'Lato',sans-serif;font-size:.8rem;">
                        <p style="color:#fff;margin:0;font-size:.8rem;">Израиль</p>
                        <p style="color:#fff;margin:0;font-size:.8rem;">Тель-Авив, ул.Нирим 3, Правый Лифт, 3-ий
                            этаж</p>
                        <p style="color:#fff;margin:0;padding-bottom:20px;font-size:.8rem;">(Здание Канадского
                            Посольства)</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr style="font-weight:bold;line-height:16px;">
        <td style="padding-top: 15px;">
            <a href="https://vk.com/gic_canada_immigeration" style="border:none" target="_blank"><img
                        src="<?= $imageURI; ?>vk.png" alt="VK" style="height:30px;width:30px;"></a>
            <a href="https://www.facebook.com/giccanada.rus/" style="border:none;padding-left:10px;padding-right:10px;"
               target="_blank"><img src="<?= $imageURI; ?>facebook.png" alt="FB" style="height:30px;width:30px;"></a>
            <a href="https://www.instagram.com/gic_canada/?hl=en" style="border:none" target="_blank"><img
                        src="<?= $imageURI; ?>instagram.png" alt="Instagram" style="height:30px;width:30px;"></a>
        </td>
        <td style="padding-top: 15px;">
            <a href="<?= ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]/"; ?>"
               style="color:#fff;text-align:center;font-size:.8rem;text-transform:uppercase;
               background-color:#FF8200;background:linear-gradient(82.05deg, #FF8200 54.81%, #FF3400 190%);text-decoration:none;
               box-shadow:0 4px 8px rgba(0, 0, 0, 0.5);border-radius:28px;line-height:30px;cursor:pointer;display:inline-block;padding:0 12px;">Перейти
                на сайт компании</a>
        </td>
    </tr>
    <tr style="font-weight:bold;line-height:16px;">
        <td colspan="2"
            style="color:#fff;font-family:'Lato',sans-serif;padding-top:20px;padding-bottom:40px;font-size:.8rem;">
            <p style="margin:0;font-size:.8rem;">&copy; <?= date( "Y" ); ?> GIC Global Immigration Corp. Все права
                защищены</p>
        </td>
    </tr>
    </tbody>
</table>