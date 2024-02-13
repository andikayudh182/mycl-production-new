<script>
    function generate() {
    var test = <?php echo json_encode($grup); ?>;
    var date = new Date().toISOString().slice(0, 10);;
    var date = "<?php echo date("d/m/Y");?>";

    var resume = <?php echo json_encode($Jumlah); ?>;
    const table = new docx.Table({
        alignment: docx.AlignmentType.CENTER,
        rows: [
            new docx.TableRow({
                tableHeader: true,
                children: [
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Kode Produksi',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Warna',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Grade',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Ukuran',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Kategori Reinforce',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Jumlah',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'In Stock',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                ],
            }),
        <?php foreach($grup as $key => $item){?>
            new docx.TableRow({
                children: [
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph('<?php echo $key;?>')],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },

                        children: [new docx.Paragraph('<?php echo $_GET['Warna'];?>')],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },

                        children: [new docx.Paragraph('<?php echo $_GET['Grade'];?>')],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },

                        children: [new docx.Paragraph('<?php echo $_GET['Ukuran'];?>')],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },

                        children: [new docx.Paragraph('<?php echo $_GET['KategoriReinforce'];?>')],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },

                        children: [new docx.Paragraph('<?php echo $item['Jumlah'];?>')],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },

                        children: [new docx.Paragraph('<?php echo $item['Jumlah']-$item['Terpakai'];?>')],
                    }),
                ],
            }),
        <?php }?>
        ],
    });

    const doc = new docx.Document({
      sections: [{
        properties: {
            page: {
                size: {
                    orientation: docx.PageOrientation.LANDSCAPE,
                },
            },
            titlePage: true,
        },
        children: [
          new docx.Paragraph({
            text : 'Stock Card',
            heading: docx.HeadingLevel.TITLE,
            alignment: docx.AlignmentType.CENTER,
          }),
          new docx.Paragraph({
            text : 'Total Produksi\t\t: ' + '<?php echo $Jumlah;?>',
            heading: docx.HeadingLevel.HEADING_1,
            break: 1,
          }),
          new docx.Paragraph({
            text : 'Tanggal Export\t\t: ' + date,
            heading: docx.HeadingLevel.HEADING_1,
            break: 1,
          }),
          new docx.Paragraph({
            children: [
                new docx.TextRun({
                text : '',
              }),
            ],
          }),
          table,
          new docx.Paragraph({
            children: [
                new docx.TextRun({
                text : date + '\t',
                break : 2,
              }),
            ],
            alignment: docx.AlignmentType.RIGHT,
          }),
          new docx.Paragraph({
            children: [
                new docx.TextRun({
                text : 'Production Manager' + '\t',
                break : 5,
              }),
            ],
            alignment: docx.AlignmentType.RIGHT,
          }),
        ],
      }]
    });
    docx.Packer.toBlob(doc).then(blob => {
      console.log(blob);
      saveAs(blob, "StockCard_<?php if(isset($_GET['Warna'])){ echo $_GET['Warna'].'_'.$_GET['Grade'].'_'.$_GET['Ukuran'].'_'.$_GET['KategoriReinforce'];}?>_"+date+".docx");
      console.log("Document created successfully");
      console.log(test[0]['JumlahBaglog']);
    });
};
</script>