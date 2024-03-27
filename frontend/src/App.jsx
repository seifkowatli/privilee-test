import { Box, Container, Stack, TextField, Typography } from "@mui/material";
import { useEffect, useState } from "react";

import { Carousel } from 'react-responsive-carousel';
import "react-responsive-carousel/lib/styles/carousel.min.css"; // requires a loader


function App() {
  const [name, setName] = useState("");
  const [discount, setDiscount] = useState("");
  const [data, setData] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch(
          `http://127.0.0.1:8000/api/venues?discount_percentage=${discount}&name=${name}`
        );
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        const result = await response.json();
        setData(result);
        console.log(result);
      } catch (error) {
        setError(error);
      }
    };

    fetchData();
  }, [name, discount]);

  return (
    <Container>
      <Stack direction="row" gap={2}>
        <TextField
          value={name}
          onChange={(e) => setName(e.target.value)}
          label="Name"
        />
        <TextField
          value={discount}
          onChange={(e) => setDiscount(e.target.value)}
          label="Discount"
        />
      </Stack>

      <Box sx={{ py : 2}}>
        {!!data && (
          <Carousel>
            {Object.keys(data).map((key) => (
              <Box key={data[key].id} sx={{position : 'relative'  , maxHeight : 250}}>
                <img src={data[key].image} alt={data[key].name} />
                <Box sx={{position : 'absolute' , bottom : '10%' , left : '10%' }}>
                  <Typography variant="h2">{data[key].name}</Typography>
                  <Typography variant="h6" textAlign="left">{data[key].discount_percentage}%</Typography>
                </Box>
              </Box>
            ))}
          </Carousel>
        )}
      </Box>
    </Container>
  );
}

export default App;
