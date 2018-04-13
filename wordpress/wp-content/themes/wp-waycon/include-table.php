  <table class="contenttable">
    <tbody>
      <?php if (get_field('typ')){ ?><tr>
        <th scope="row">Typ</th>
        <td><?php the_field('typ'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('ranges')){ ?><tr>
        <th scope="row">Диапазоны</th>
        <td><?php the_field('ranges'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('measurement_range')){ ?><tr>
        <th scope="row">Измерительный диапазон</th>
        <td><?php the_field('measurement_range'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('resolutionmax')){ ?><tr>
        <th scope="row">Разрешение</th>
        <td><?php the_field('resolutionmax'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('linearity')){ ?><tr>
        <th scope="row">Линейность макс.</th>
        <td><?php the_field('linearity'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('protection_class')){ ?><tr>
        <th scope="row">Класс защиты</th>
        <td><?php the_field('protection_class'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('output')){ ?><tr>
        <th scope="row">Выход</th>
        <td><?php the_field('output'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('output_analog')){ ?><tr>
        <th scope="row">Аналоговый выход</th>
        <td><?php the_field('output_analog'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('output_digital')){ ?><tr>
        <th scope="row">Цифровой выход</th>
        <td><?php the_field('output_digital'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('frequency_max')){ ?><tr>
        <th scope="row">Частота макс.</th>
        <td><?php the_field('frequency_max'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('housing')){ ?><tr>
        <th scope="row">Корпус</th>
        <td><?php the_field('housing'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('diameter_housing')){ ?><tr>
        <th scope="row">Диаметр корпуса</th>
        <td><?php the_field('diameter_housing'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('displacement_speed')){ ?><tr>
        <th scope="row">Скорость перемещения</th>
        <td><?php the_field('displacement_speed'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('operating_temperature')){ ?><tr>
        <th scope="row">Рабочая температура</th>
        <td><?php the_field('operating_temperature'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('material')){ ?><tr>
        <th scope="row">Материал</th>
        <td><?php the_field('material'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('gap_sensor_tape')){ ?><tr>
        <th scope="row">Зазор сенсор/лента</th>
        <td><?php the_field('gap_sensor_tape'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('accuracy')){ ?><tr>
        <th scope="row">Точность</th>
        <td><?php the_field('accuracy'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('measured_value')){ ?><tr>
        <th scope="row">Измеренное значение</th>
        <td><?php the_field('measured_value'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('voltage_supply')){ ?><tr>
        <th scope="row">Напряжение питания</th>
        <td><?php the_field('voltage_supply'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('magnetic_cursor')){ ?><tr>
        <th scope="row">Магнитный курсор</th>
        <td><?php the_field('magnetic_cursor'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('pol_pitch')){ ?><tr>
        <th scope="row">Шаг полюса</th>
        <td><?php the_field('pol_pitch'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('input')){ ?><tr>
        <th scope="row">Вход</th>
        <td><?php the_field('input'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('supply')){ ?><tr>
        <th scope="row">Питание</th>
        <td><?php the_field('supply'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('channels')){ ?><tr>
        <th scope="row">Каналы</th>
        <td><?php the_field('channels'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('input_analog')){ ?><tr>
        <th scope="row">Аналоговый вход</th>
        <td><?php the_field('input_analog'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('input_control')){ ?><tr>
        <th scope="row">Контроль входа</th>
        <td><?php the_field('input_control'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('sensor_supply')){ ?><tr>
        <th scope="row">Питание датчика</th>
        <td><?php the_field('sensor_supply'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('digits')){ ?><tr>
        <th scope="row">Цифры</th>
        <td><?php the_field('digits'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('interfaces')){ ?><tr>
        <th scope="row">Интерфейсы</th>
        <td><?php the_field('interfaces'); ?></td>
      </tr><?php } ?>
      <?php if (get_field('sensor_types')){ ?><tr>
        <th scope="row">Типы датчиков</th>
        <td><?php the_field('sensor_types'); ?></td>
      </tr><?php } ?>
      <tr>
        <th scope="row">Скачать</th>
        <td class="downloadrow">
          <?php if( have_rows('download') ): while ( have_rows('download') ) : the_row(); ?>
            <?php
              $attachment_id = get_sub_field('file');
              $url = wp_get_attachment_url( $attachment_id );
            ?>
            <a href="<?php echo $url; ?>" title="<?php echo $title; ?>" target="_blank"><?php the_sub_field('title') ?></a>
          <?php endwhile; endif; ?>
        </td>
      </tr>
    </tbody>
  </table>


